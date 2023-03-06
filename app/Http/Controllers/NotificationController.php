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
use Illuminate\Support\Facades\Date;
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

        $birth_years = collect(range(-1, 1))->map(function ($item) {
            return (string) date('Y') + $item;
        });

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

->whereMonth('started_date',$mes)->whereYear('started_date',$year);

'birth_years','month','mes','year'


$date_i = Carbon::now()->startOfMonth()->month($mes);
        $inicio_mes = Carbon::now()->month($mes)->day($dias);*/

        $b_fecha_inicio = $request->b_fecha_inicio;
        $b_fecha_final = $request->b_fecha_final;

        $date = Carbon::now();

        $date = $date->format('m');
        $month = collect(today()->startOfMonth()->subMonths(12)->monthsUntil(today()->startOfMonth()))->mapWithKeys(fn ($month) => [$month->month => $month->monthName]);
        $month = $month->push("Seleccionar un mes");
      $user = Auth::user()->email;
      $user_model = Auth::user();
      $do = 8;

      $ad = 9;
      $administrativo = 6;

      if( isset($b_fecha_inicio)&& isset($b_fecha_final)){

        $notifications = DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','em.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->whereDate('started_date','>=',$b_fecha_inicio)->whereDate('started_date','<=',$b_fecha_final)
        ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status','n.started_time','n.finish_time')
        ->orderBy('started_date','desc')
        ->paginate(10);

      }else{
        $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status','n.started_time','n.finish_time')
          ->orderBy('started_date','desc')
          ->paginate(15);
      }

       /* if($user_model->center_cost_id == $this->c_admin || ($user_model->center_cost_id == $this->administrativo AND $user_model->profile_id == 1 ) || ($user_model->center_cost_id == $this->do AND $user_model->profile_id == $this->p_visor)){

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('positions as pos','em.position_id','=','pos.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->whereMonth('started_date',$date)
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','pos.name as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status','n.started_time','n.finish_time')
          ->orderBy('started_date','desc')
          ->get();

        }else{

          $notifications = DB::table('notifications as n')
          ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
          ->join('employees as em', 'n.employee_id','=','em.id')
          ->join('center_costs as cc','n.center_cost_id','=','cc.id')
          ->join('bosses as boss','n.boss_id','=','boss.id')
          ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
          ->where('n.user_id',$user_model->id)->where('em.status'.'true')->whereMonth('started_date',$date)
          ->select('n.id as id','idt.name as tipo_identificacion','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','em.position_id as cargo','cc.name as centro_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total de dias','total_hours as total de horas','observation as observacion','n.support','n.user_id','n.status','n.started_time','n.finish_time')
          ->orderBy('started_date','desc')
          ->get();

        }*/




      return view('notifications.index', compact('notifications','user_model','user','date','do','date','b_fecha_inicio','b_fecha_final'));





    }


    public function create(){


        $user = Auth::user()->id;
        $user_model = Auth::user();
        $center_costs = $this->center($user_model);
        $employees = $this->employee($user_model);
        $types = IdentificationType::all()->pluck('name','id');
        $bosses = $this->boss($user_model);
        $notifications = NotificationType::select('name','id')->whereNot('notification_category_id',7)->orderBy('name','asc')->pluck('name','id');

        return view('notifications.create', compact('center_costs','employees','types','bosses','notifications','user'));
    }


    public function store(StoreNotificationRequest $request)
    {

        $inicio = $request->started_date." ".$request->started_time;
        $final = $request->finish_date." ".$request->finish_time;

        $request->validated();

        $user = Auth::user()->id;
        $notification = $request->all();
        $notification_object = (object)$notification;
        $notification_object->user_id = $user;
        $fechaInicio = Carbon::parse($notification_object->started_date);
        $fechafinalizacion = Carbon::parse($notification_object->finish_date);
        $notification_object->total_days = $this->diasTrabajados((string)$inicio, (string)$final,$request->notifications_type_id)[1];
        $notification_object->total_hours = $this->diasTrabajados((string)$inicio, (string)$final,$request->notifications_type_id)[0];
        $notification_array = (array)$notification_object;



       $notification = Notification::create($notification_array);
       return redirect()->route('notifications.show',compact('notification'))->with('success', 'Novedad creada');


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

        $inicio = $request->started_date." ".$request->started_time;
        $final = $request->finish_date." ".$request->finish_time;

        $notification =  Notification::find($notification->id);


        $fechaInicio = Carbon::parse($request->started_date);
        $fechafinalizacion = Carbon::parse($request->finish_date);

        $request['total_days'] = $this->diasTrabajados((string)$inicio, (string)$final,$request->notifications_type_id)[1];
        $request['total_hours'] = $this->diasTrabajados((string)$inicio, (string)$final,$request->notifications_type_id)[0];


        $request['support'] = $request->support  != "" || $request->support != null ? true : false;
        $notification->update($request->all());

        return redirect()->route('notifications.show',compact('notification'))->with('success', 'Novedad Actualizada');
    }


    public function destroy($id)
    {
       $notification = Notification::find($id);

       $notification->delete();
       return redirect()->route('notifications.index')->with('success', 'Novedad Eliminada');
    }


    public function employee(User $user){

        $tsa = 3;

        if($user->center_cost_id == $this->c_admin || ($user->center_cost_id == $this->administrativo AND $user->profile_id == 1 ) || ($user->center_cost_id == $this->do AND $user->profile_id == $this->p_visor)){

          return Employee::where('status',true)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        }elseif($user->center_cost_id == $this->operacional AND $user->profile_id == $this->p_visor){

            return Employee::where('status',true)->where('center_cost_id', $tsa)->orWhere('center_cost_id', '=', $user->center_cost_id)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

        }else{

          return Employee::where('status',true)->where('center_cost_id', $user->center_cost_id)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');

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


    public function diasTrabajados($inicio,$final,$novedades)
    {

        $maternidad = 6;
        $paternidad = 7;


        $data = [];

        $datetimeStart = new \DateTime($inicio);
        $datetimeFinish = new \DateTime($final);

        $break_time_start = "12:00";
        $break_time_final = "12:59";

        $interval = $datetimeStart->diff($datetimeFinish);

        $fecha_inicio_acomparar = $datetimeStart->format('Y-m-d');
        $fecha_final_acomparar = $datetimeFinish->format('Y-m-d');

        $horas_descanso_acumulada = 0;
        $horas_reales = 0;
        $horas_transcurridas = [];
        $countWeekend = 0;
        $dias = 0;
        $week = 0;

        /* Horarios */


        $HORARIOSABADO =  4;
        $HORARIOVIERNES =  8;
        $HORARIONORMAL = 9;

        $horarioFijoSalida = strtotime("17:00:00");

        if($fecha_inicio_acomparar != $fecha_final_acomparar && $novedades == $maternidad){

            $interval = $datetimeStart->diff($datetimeFinish);
            $dias = 126;
            $horas_reales = (126*8) - 16*8;

        }else if ($fecha_inicio_acomparar != $fecha_final_acomparar && $novedades == $paternidad){

            $dias = 15;
            $horas_reales = (15*8) - 2*8;

        }


        if ($fecha_inicio_acomparar == $fecha_final_acomparar && ($novedades != $paternidad && $novedades != $maternidad)) {

            $inicio_recorrido = $datetimeStart->format('Y-m-d H:i:s');
            $final_recorrido = $datetimeFinish->format('Y-m-d H:i:s');

            $date_obj = new \DateTime($inicio_recorrido);
            $date_incr = $inicio_recorrido;
            $incr = 1;


            while ($date_incr < $final_recorrido) {
                $date_incr = $date_obj->format('Y-m-d H:i:s');
                $time = $date_obj->format('H:i');
                $date_obj->modify('+' . $incr . ' minutes');

                array_push($horas_transcurridas, $time);

                if ($time == $break_time_start || $time == $break_time_final) {
                    $horas_descanso_acumulada += 1;
                }
            }


            if ($horas_descanso_acumulada == 2) {
                $horas_reales = (int)$interval->format('%H') - 1;
            } else {
                $hora = (int)$interval->format('%H');
                $horas_reales =  $hora;
            }

            $determinarDia = strtotime($inicio);

            $day = date("w", $determinarDia);

            /* Checking if the number of hours worked is equal to the number of hours in a day. */
            switch ($day) {
                case '6':
                    if ($horas_reales == $HORARIOSABADO) {
                        $dias = 1;
                    } else {
                        $dias = 0;
                    }
                    break;
                case '5':
                    if ($horas_reales == $HORARIOVIERNES) {
                        $dias = 1;
                    } else {
                        $dias = 0;
                    }
                    break;
                default:
                    if ($horas_reales == $HORARIONORMAL) {
                        $dias = 1;
                    } else {
                        $dias = 0;
                    }
                    break;
            }
        }


        if ($fecha_inicio_acomparar != $fecha_final_acomparar && ($novedades != $paternidad && $novedades != $maternidad)) {


            $formatDayHours = $final;
            $fechafinalMasHora = new \DateTime($formatDayHours);
            $horaFinal = strtotime($fechafinalMasHora->format('H:i:s'));

            if ($horaFinal == $horarioFijoSalida) {
                $fechaInicio = strtotime($inicio);
                $fechaFin = strtotime($final);

                $interval = $datetimeStart->diff($datetimeFinish);

                $week = 0;

                for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
                    echo date("D", $i) . " " . date("w", $i) . "<br>";
                    if (date("w", $i) == 0) {
                        $countWeekend += 1;
                    }

                    switch (date("w", $i)) {
                        case '0':
                            $week += 0;
                            break;
                        case '5':
                            $week += 8;
                            break;
                        case '6':
                            $week += 4;
                            break;
                        default:
                            $week += 9;
                    }
                }

                $diasExactos =  (int)$interval->format('%a') +  1;

                if ($countWeekend != 0) {
                    $dias = $diasExactos - $countWeekend;
                } else {
                    $dias = $diasExactos;
                }

                $horas_reales = $week;


            } else if ($horaFinal <= $horarioFijoSalida) {



                $horarioAperturaSabado = "08:00";
                $horarioCierreSabado = "12:00:00";

                $horarioAperturaViernes = "07:00";
                $horarioCierreViernes = "16:00";

                $fechaInicio = strtotime($inicio);
                $fechaFin = strtotime($final);

                $horasParcialesReales = 0;
                $week = 0;

                for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {

                    if (date("w", $i) == 0) {
                        $countWeekend += 1;
                    }

                    switch (date("w", $i)) {
                        case '0':
                            $week += 0;
                            break;
                        case '5':
                            $week += 8;
                            break;
                        case '6':
                            $week += 4;
                            break;
                        default:
                            $week += 9;
                    }
                }


                $diasExactos =  (int)$interval->format('%a') +  1;



                if ($countWeekend != 0) {
                    $dias = $diasExactos - $countWeekend;
                } else {
                    $dias = $diasExactos;
                }

                $horas_reales = $week;

                $final_recorrido = $datetimeFinish->format('Y-m-d');
                $final_recorrido_date = strtotime($final_recorrido);


                if(date("w", $final_recorrido_date) == 6){

                }


                if (date("w", $final_recorrido_date) == 6) {
                    $inicio_recorridoHora = $final_recorrido . " " . "08:00:00";
                } else {
                    $inicio_recorridoHora = $final_recorrido . " " . "07:00:00";
                }

                $final_recorridoHora =  $final_recorrido . " " . $fechafinalMasHora->format('H:i:s');

                if(date("w", $final_recorrido_date) == 6 && ($fechafinalMasHora->format('H:i:s') == $horarioCierreSabado) ){

                    $dias = $dias+=1;
                }


                $datetimeStartHour = new \DateTime($inicio_recorridoHora);
                $datetimeFinishHour = new \DateTime($final_recorridoHora);

                $interval = $datetimeStartHour->diff($datetimeFinishHour);


                $date_obj = new \DateTime($inicio_recorridoHora);
                $date_incr = $inicio_recorridoHora;
                $incr = 1;


                while ($date_incr < $final_recorridoHora) {
                    $date_incr = $date_obj->format('Y-m-d H:i:s');
                    $time = $date_obj->format('H:i');
                    $date_obj->modify('+' . $incr . ' minutes');

                    array_push($horas_transcurridas, $time);

                    if ($time == $break_time_start || $time == $break_time_final) {
                        $horas_descanso_acumulada += 1;
                    }
                }

                if ($horas_descanso_acumulada == 2) {
                    $horasParcialesReales = (int)$interval->format('%H') - 1;
                } else {
                    $horasParcialesReales =  (int)$interval->format('%H');
                }

                $determinarDia = strtotime($inicio_recorridoHora);

                $day = date("w", $determinarDia);

                switch ($day) {
                    case '6':
                        if ($horas_reales == $HORARIOSABADO) {
                            $dias = 1;
                        } else {
                            $dias -= 1;
                            $horas_reales = $horas_reales - ($HORARIOSABADO - $horasParcialesReales);
                        }
                        break;
                    case '5':
                        if ($horas_reales == $HORARIOVIERNES) {
                            $dias = 1;
                        } else {
                            $dias -= 1;
                            $horas_reales = $horas_reales - ($HORARIOVIERNES - $horasParcialesReales);
                        }
                        break;
                    default:
                        if ($horas_reales == $HORARIONORMAL) {
                            $dias = 1;
                        } else {
                            $dias -= 1;
                            $horas_reales = $horas_reales - ($HORARIONORMAL - $horasParcialesReales);
                        }
                        break;
                }

            }
        }


        return $data = [$horas_reales, $dias];
    }


}
