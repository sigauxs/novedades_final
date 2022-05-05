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
use App\Models\User;

/* Modulos  */

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PeriodInterval;

class NotificationController extends Controller
{

    public $administrativo = 6;
    public $operacional = 1;
    public $do = 8;

    public $p_visor = 2;
    public $p_admin = 1;
    public $c_admin = 9;

    public $jefe_facturacion = ["facturacion@sigpeconsultores.com.co",7];


    public function index(Request $request)
    {
/*
$mes = $request['mes'];
$dias = $request['dias'];
$quince_dias = 15;
$treinta_dias = 30;
if($dias == $quince_dias){
   $dias = $quince_dias;
}else{
    $dias = $treinta_dias;
}
$date_i = Carbon::now()->startOfMonth()->month($mes);
        $inicio_mes = Carbon::now()->month($mes)->day($dias);*/
        $date = Carbon::now();

$date = $date->format('m');
        $month = collect(today()->startOfMonth()->subMonths(12)->monthsUntil(today()->startOfMonth()))
        ->mapWithKeys(fn ($month) => [$month->month => $month->monthName]);

      $user = Auth::user()->email;
      $user_model = Auth::user();
      $do = 8;

      $ad = 9;
      $administrativo = 6;

        if($user_model->center_cost_id == $this->c_admin || ($user_model->center_cost_id == $this->administrativo AND $user_model->profile_id == 1 ) || ($user_model->center_cost_id == $this->do AND $user_model->profile_id == $this->p_visor)){

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('positions as pos','em.position_id','=','pos.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->whereMonth('started_date',$date)
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status')
          ->orderBy('started_date','desc')
          ->get();

        }else{

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->where('n.user_id',$user_model->id)->whereMonth('started_date',$date)
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status')
          ->orderBy('started_date','desc')
          ->get();

        }


      return view('notifications.index', compact('notifications','user_model','user','date','do','date'));





    }


    public function create(){


        $user = Auth::user()->id;
        $user_model = Auth::user();
        $center_costs = $this->center($user_model);
        $employees = $this->employee($user_model);
        $types = IdentificationType::all()->pluck('name','id');
        $bosses = $this->boss($user_model);
        $notifications = NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');

        return view('notifications.create', compact('center_costs','employees','types','bosses','notifications','user'));
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



        $notification_object->business_days = $notification_object->total_days * 8;
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
        $fechaInicio = Carbon::parse($request->started_date);
        $fechafinalizacion = Carbon::parse($request->finish_date);
        $request['total_days'] = $fechaInicio->floatDiffInDays($fechafinalizacion);
        $request['total_hours'] = $fechaInicio->floatDiffInHours($fechafinalizacion);
        $request['support'] = $request->support  != "" || $request->support != null ? true : false;
        $request['business_days'] = $request->total_days * 8;
        $notification->update($request->all());
        return redirect()->route('notifications.show',compact('notification'));
    }


    public function destroy($id)
    {

    }


    public function employee(User $user){

        $tsa = 3;

        if($user->center_cost_id == $this->c_admin || ($user->center_cost_id == $this->administrativo AND $user->profile_id == 1 ) || ($user->center_cost_id == $this->do AND $user->profile_id == $this->p_visor)){

          return Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        }elseif($user->center_cost_id == $this->operacional AND $user->profile_id == $this->p_visor){

            return Employee::where('center_cost_id', $tsa)->orWhere('center_cost_id', '=', $user->center_cost_id)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        }else{

          return Employee::where('center_cost_id', $user->center_cost_id)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        }

    }

    public function center(User $user){

        $tsa = 3;

        $user = Auth::user();

        if($user->center_cost_id == $this->c_admin || ($user->center_cost_id == $this->administrativo AND $user->profile_id == 1 ) || ($user->center_cost_id == $this->do AND $user->profile_id == $this->p_visor)){
          return CenterCost::all()->pluck('name', 'id')->filter(function ($value, $key) {
                  return $value != "admin";
          });

        }elseif($user->center_cost_id == $this->operacional AND $user->profile_id == $this->p_visor){
            return CenterCost::where('id', $tsa)->orWhere('id', '=', $user->center_cost_id)->pluck('name', 'id');
        }
        else{
            return CenterCost::where('id', $user->center_cost_id)->pluck('name', 'id');
        }

    }



    public function boss(User $user){

        if($user->center_cost_id == $this->c_admin || ($user->center_cost_id == $this->administrativo AND $user->profile_id == $this->p_admin ) || ($user->center_cost_id == $this->do AND $user->profile_id == $this->p_visor)){
          return Boss::all()->pluck('fullname', 'id');

        }elseif($user->email == $this->jefe_facturacion[0]){

          return Boss::where('center_cost_id', $user->center_cost_id)
                      ->where('id',$this->jefe_facturacion[1])
                      ->pluck('fullname', 'id');

        }else{
            return Boss::where('center_cost_id', $user->center_cost_id)->pluck('fullname', 'id');
        }
    }


}
