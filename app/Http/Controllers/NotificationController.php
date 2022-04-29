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
     
      
        $user_model = Auth::user();

        if($user_model->centerCost->name == "Otro"){

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion')
          ->orderBy('started_date','desc')
          ->get();

        }else{

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->where('n.user_id',$user_model->id)
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion')
          ->orderBy('started_date','desc')
          ->get();
              
        }




      return view('notifications.index', compact('notifications','user_model','user'));
  

     

      
    }

  
    public function create(){

        
      $user = Auth::user()->id;
        $user_model = Auth::user();
        $center_costs = $this->center($user_model);
        $employees = $this->employee($user_model);
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = $this->boss($user_model);
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
        $user_model = Auth::user();
        $center_costs = $this->center($user_model);
        $employees = $this->employee($user_model);
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = $this->boss($user_model);
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


    public function employee($user){

        $user->centerCost->name;

        if($user->centerCost->name == "Otro"){
          return Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
        }else{
          return Employee::where('center_cost_id', $user->center_cost_id)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
        }

    }

    public function center($user){

        $user->centerCost->name;
        $sc = "jefeoperativo@sigpeconsultores.com.co";
        $tsa = 3;

        if($user->centerCost->name == "Otro"){
          return CenterCost::all()->pluck('name', 'id')->filter(function ($value, $key) {
                  return $value != "Otro";
          });

        }elseif($user->email == $sc){
            return CenterCost::where('id', $tsa)->orWhere('id', '=', $user->center_cost_id)->pluck('name', 'id');
        }
        else{
            return CenterCost::where('id', $user->center_cost_id)->pluck('name', 'id');
        }

    }

    public function boss($user){

        if($user->centerCost->name == "Otro"){
          return Boss::all()->pluck('fullname', 'id');
        }else{
            return Boss::where('center_cost_id', $user->center_cost_id)->pluck('fullname', 'id');
        }
    }
}
