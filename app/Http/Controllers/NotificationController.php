<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use Illuminate\Http\Request;


/* Models */

Use App\Models\CenterCost;
use App\Models\Employee;
use App\Models\IdentificationType;
use App\Models\Boss;
use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\Position;

/* Modulos  */

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function index()
    {

      $user = Auth::user()->email;
      $user_id = Auth::user()->id;

      $av = "avidal@sigpeconsultores.com.co";
      $bl = "blamby@sigpeconsultores.com.co";
      $sc = "jefeoperativo@sigpeconsultores.com.co";
      $lc = "liderproyecto@sigpeconsultores.com.co";
      $mt = "jefeadmon@sigpeconsultores.com.co";
      $kb = "gerencia@sigpeconsultores.com.co";

      $correos = [$av,$bl,$sc,$lc,$mt,$kb];

      
      $mercadeo = 2;
      $tsa = 3;
      $operacional = 1;
      $gerencia = 7;
      $administrativo = 6;
      $drummot = 4;
      $promigas = 5;
     
      

        if( in_array($user,$correos)){

        $notifications = DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','n.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->where('n.user_id',$user_id)
        ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion')
        ->orderBy('started_date','desc')
        ->get();

        }else{

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('positions as pos','n.position_id','=','pos.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion')
          ->orderBy('started_date','desc')
          ->get();

        }
       


      return view('notifications.index', compact('notifications','correos','user'));
  

     

      
    }

  
    public function create(){

        $user = Auth::user()->email;

       
        $center_costs = $this->center($user);
        $employees = $this->employee($user);
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = $this->boss($user);
        $notifications = NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');

        return view('notifications.create', compact('center_costs','employees','types','positions','bosses','notifications','user'));
    }

    
    public function store(StoreNotificationRequest $request)
    {

        $request->validated();
        $user = Auth::user()->id;
        $notification = $request->all();
        $notification_object = (object)$notification;
        $notification_object->user_id = $user;
        $fechaInicio = Carbon::parse($notification_object->started_date);
        $fechafinalizacion = Carbon::parse($notification_object->finish_date);
        $notification_object->total_days = $fechaInicio->diffInDays($fechafinalizacion);
        $notification_object->total_hours = $fechaInicio->floatDiffInHours($fechafinalizacion);

        $notification_array = (array)$notification_object;

        

       $notification = Notification::create($notification_array);
       return redirect()->route('notifications.show',compact('notification'));
        
    }


    public function show(Notification $notification)
    {
        
        $notification =  Notification::find($notification->id);
      
      
        return view('notifications.show',compact('notification'));
    }

  
    public function edit(Notification $notification)
    {
      $user = Auth::user()->email;
       $center_costs = $this->center($user);
        $employees = $this->employee($user);
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = $this->boss($user);
        $notifications = NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');
        $notification = Notification::find($notification->id);
        $notification->started_date = Carbon::parse($notification->started_date);
        $notification->finish_date = Carbon::parse($notification->finish_date);

         return view('notifications.edit',compact('center_costs','employees','types','positions','bosses','notifications','notification'));
    }

    public function update(Request $request,Notification $notification)
    {
        
        $notification =  Notification::find($notification->id);
        $notification->update($request->all());
        return redirect()->route('notifications.show',compact('notification'));
    }

    
    public function destroy($id)
    {
        
    }


    public function employee($email){

        $av = "avidal@sigpeconsultores.com.co";
        $bl = "blamby@sigpeconsultores.com.co";
        $sc = "jefeoperativo@sigpeconsultores.com.co";
        $lc = "liderproyecto@sigpeconsultores.com.co";
        $mt = "jefeadmon@sigpeconsultores.com.co";
        $kb = "gerencia@sigpeconsultores.com.co";

        $mercadeo = 2;
        $tsa = 3;
        $operacional = 1;
        $gerencia = 7;
        $administrativo = 6;
        $drummot = 4;
        $promigas = 5;


        
        switch ($email) {
            case $bl:
              return Employee::where('center_cost_id', $mercadeo)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
               break;
            case $sc:
              return Employee::where('center_cost_id', $tsa)->orWhere('center_cost_id', '=', $operacional)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                  break;
            case $kb:
              return Employee::where('center_cost_id', $gerencia)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                  break;
            case $mt:
              return Employee::where('center_cost_id', $administrativo)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                  break;
            case $av:
              return Employee::where('center_cost_id', $drummot)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                  break;
            case $lc:
               return Employee::where('center_cost_id', $promigas)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                        break;            
            default:
              return Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
                break;
        }

    }

    public function center($email){

        $av = "avidal@sigpeconsultores.com.co";
        $bl = "blamby@sigpeconsultores.com.co";
        $sc = "jefeoperativo@sigpeconsultores.com.co";
        $lc = "liderproyecto@sigpeconsultores.com.co";
        $mt = "jefeadmon@sigpeconsultores.com.co";
        $kb = "gerencia@sigpeconsultores.com.co";

        $mercadeo = 2;
        $tsa = 3;
        $operacional = 1;
        $gerencia = 7;
        $administrativo = 6;
        $drummot = 4;
        $promigas = 5;

        switch ($email) {
            case $bl:
              return CenterCost::where('id', $mercadeo)->pluck('name', 'id');
               break;
            case $sc:
              return CenterCost::where('id', $tsa)->orWhere('id', '=', $operacional)->pluck('name', 'id');
                  break;
            case $kb:
              return CenterCost::where('id', $gerencia)->pluck('name', 'id');
                  break;
            case $mt:
              return CenterCost::where('id', $administrativo)->pluck('name', 'id');
                  break;
            case $av:
              return centerCost::where('id', $drummot)->pluck('name', 'id');
                  break;
            case $lc:
               return centerCost::where('id', $promigas)->pluck('name', 'id');
                  break;            
            default:
              return CenterCost::all()->pluck('name', 'id');
                break;
        }
    }

    public function boss($email){

        $av = "avidal@sigpeconsultores.com.co";
        $bl = "blamby@sigpeconsultores.com.co";
        $sc = "jefeoperativo@sigpeconsultores.com.co";
        $lc = "liderproyecto@sigpeconsultores.com.co";
        $mt = "jefeadmon@sigpeconsultores.com.co";
        $kb = "gerencia@sigpeconsultores.com.co";

        $mercadeo = 2;
        $tsa = 3;
        $operacional = 1;
        $gerencia = 7;
        $administrativo = 6;
        $drummot = 4;
        $promigas = 5;

        switch ($email) {
          case $bl:
            return Boss::where('center_cost_id', $mercadeo)->pluck('fullname', 'id');
             break;
          case $sc:
            return Boss::where('center_cost_id', $operacional)->pluck('fullname', 'id');
                break;
          case $kb:
            return Boss::where('center_cost_id', $gerencia)->pluck('fullname', 'id');
                break;
          case $mt:
            return Boss::where('center_cost_id', $administrativo)->pluck('fullname', 'id');
                break;
          case $av:
            return Boss::where('center_cost_id', $drummot)->pluck('fullname', 'id');
                break;
          case $lc:
             return Boss::where('center_cost_id', $promigas)->pluck('fullname', 'id');
                break;            
          default:
            return Boss::all()->pluck('fullname', 'id');
              break;
      }
    }
}
