<?php

namespace App\Http\Controllers;

/* Extensiones */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

/* Modelos */
use App\Models\CenterCost;
use App\Models\Employee;
use App\Models\User;
use App\Models\NotificationType;
use App\Models\Boss;
use App\Models\IdentificationType;
use App\Models\Notification;

/* Validaciones */
use App\Http\Requests\StoreNotificationRequest;
use App\Models\NotificationCategory;

class ApplicationFormController extends Controller
{

    public function index()
    {
        return view('applicationForms.index');
    }


    public function create(Request $request)
    {
        $identification = $request->identification;

        $validated = $request->validate([
            'identification' => 'required|integer',
        ]);

        $employee_filter = DB::table('employees as e')
            ->where('identification', $identification)
            ->select('*')
            ->get();

        if ($employee_filter->isEmpty()) {

            return redirect()->action(
                [ApplicationFormController::class, 'index']
            )->with('error', 'El usuario no existe');
        } else {

            $center_costs = $this->center($employee_filter[0]->center_cost_id);
            $type_notifications = $this->type_notification();
            $employee = $this->employee($employee_filter[0]->identification);
            $bosses = $this->bosses($employee_filter[0]->center_cost_id);
            $types = $this->type_identification();

            return view('applicationForms.create', compact('center_costs', 'type_notifications', 'employee', 'bosses', 'types'));
        }
    }


    public function store(StoreNotificationRequest $request)
    {


        $request->validated();

        $notification =  new Notification();

        $inicio = $request->started_date." ".$request->started_time;
        $final = $request->finish_date." ".$request->finish_time;

        $fechaInicio = Carbon::parse($request->started_date);
        $fechafinalizacion = Carbon::parse($request->finish_date);

        $notification->type_identification_id = $request->type_identification_id;
        $notification->employee_id = $request->employee_id;
        $notification->center_cost_id = $request->center_cost_id;
        $notification->boss_id = $request->boss_id;
        $notification->notifications_type_id = $request->notifications_type_id;
        $notification->user_id = 8;
        $notification->started_date = $request->started_date;
        $notification->finish_date = $request->finish_date;
        $notification->started_time = $request->started_time;
        $notification->finish_time = $request->finish_time;
        $notification->total_days = $this->diasTrabajados((string)$inicio, (string)$final)[1];
        $notification->total_hours = $this->diasTrabajados((string)$inicio, (string)$final)[0];
        $notification->observation = $request->observation;
        $notification->support = $request->support;


        if ($notification->save()) {
            return redirect()->action(
                [ApplicationFormController::class, 'show'],
                ['applicationForm' => $notification->id]
            );
        }


        //return redirect()->route('applicationForms.show',compact('notification'))->with('success', 'Novedad creada');

        //return redirect('/applicationsForms/{$notification}');

    }


    public function show($id)
    {
        $applicationForm =  Notification::find($id);
        return view('applicationForms.show', compact('applicationForm'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    /* Vista de Informes */


    public function summary(Request $request)
    {

        define("CTPE", 1);
        define("CTPA", 2);
        define("CTPNR", 3);
        define("CTPO", 4);
        define("CTPR", '8');

        /*
        tpm  = Tiempo perdido mensual
        tpe  = Tiempo por perdido por enfermedades comun.
        tpa  = Tiempo perdido por incapacidades de Accidentes laborales.
        tpo  = Tiempo perdido por otras licencias.
        tpnr =  Tiempo perdido por licencias no remuneradas

        1 Incapacidades enfermedad común
        2 Incapacidades de Accidentes laborales
        3 Licencias no remuneradas
        4 Otras licencias
        5 Retiro
        6 Ingreso
        7 Pagos extras
        8 Licencias remuneradas
        9 vacaciones


        */
        $meses = $month = collect(today()->startOfMonth()->subMonths(12)->monthsUntil(today()->startOfMonth()))->mapWithKeys(fn ($month) => [$month->month => $month->monthName]);
        $mes = (int)$request->mes;
        //$category = $request->notificationCategory_id;

        //$notificationCategories = $this->notification_category();



        $tpm = DB::table('notifications')->select('*')->whereMonth('started_date', $mes)->sum('total_days');
        $tple = DB::table('notifications as n')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')
            ->join('notification_categories as nc', 'nt.notification_category_id', '=', 'nc.id')
            ->select('*')->where('nc.id', CTPE)->whereMonth('started_date', $mes)->sum('total_hours');

        $tpal = DB::table('notifications as n')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')
            ->join('notification_categories as nc', 'nt.notification_category_id', '=', 'nc.id')
            ->select('*')->where('nc.id', CTPA)->whereMonth('started_date', $mes)->sum('total_hours');

        $tpol = DB::table('notifications as n')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')
            ->join('notification_categories as nc', 'nt.notification_category_id', '=', 'nc.id')
            ->select('*')->whereIn('nc.id', [4, 8])
            ->whereMonth('started_date', $mes)->sum('total_hours');

        $tplnr = DB::table('notifications as n')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')
            ->join('notification_categories as nc', 'nt.notification_category_id', '=', 'nc.id')
            ->select('*')->where('nc.id', CTPNR)->whereMonth('started_date', $mes)->sum('total_hours');


        return view('applicationForms.statisticsNotification', compact('mes', 'meses', 'tpm', 'tpal', 'tpol', 'tple', 'tplnr'));
    }


    /* Menu desplegado de centro de costo */

    public function center($center_cost_id)
    {
        return CenterCost::where('id', $center_cost_id)->pluck('name', 'id');
    }

    public function type_notification()
    {
        return NotificationType::select('name', 'id')->orderBy('name', 'asc')->pluck('name', 'id');
    }

    public function employee($identification)
    {
        return Employee::where('identification', $identification)->where('status', true)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"), 'id')->pluck('name', 'id');
    }

    public function bosses($center_cost_id)
    {
        return Boss::where('center_cost_id', $center_cost_id)->pluck('fullname', 'id');
    }

    public function type_identification()
    {
        return IdentificationType::where('id', 1)->pluck('name', 'id');
    }

    public function notification_category()
    {
        $c =  NotificationCategory::select('name', 'id')->limit(4)->pluck('name', 'id');
        $c[99] = 'Tiempo perdido mensual';

        return $c;
    }


    public function diasTrabajados($inicio, $final)
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

        switch ($tipoNovedad) {
            case '6':
                # code...
                break;
            case 'value':
                    # code...
                break;
            default:
                # code...
                break;
        }


        if ($fecha_inicio_acomparar == $fecha_final_acomparar) {

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


        if ($fecha_inicio_acomparar != $fecha_final_acomparar) {


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
                $horarioCierreSabado = "12:00";

                $horarioAperturaViernes = "07:00";
                $horarioCierreViernes = "16:00";

                $fechaInicio = strtotime($inicio);
                $fechaFin = strtotime($final);

                $horasParcialesReales = 0;
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

                $final_recorrido = $datetimeFinish->format('Y-m-d');
                $final_recorrido_date = strtotime($final_recorrido);



                if (date("w", $final_recorrido_date) == 6) {
                    $inicio_recorridoHora = $final_recorrido . " " . "08:00:00";
                } else {
                    $inicio_recorridoHora = $final_recorrido . " " . "07:00:00";
                }

                $final_recorridoHora =  $final_recorrido . " " . $fechafinalMasHora->format('H:i:s');

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
                            echo $HORARIOSABADO - $horasParcialesReales;
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


        /*if($fecha_inicio_acomparar != $fecha_final_acomparar){

            $fechaInicio=strtotime($inicio);
            $fechaFin=strtotime($final);

            $interval = $datetimeStart->diff($datetimeFinish);

            for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                if(date("w",$i) == 0){
                    $countWeekend+=1;
                }
            }

            if($countWeekend != 0){
               $dias = (int)$interval->format('%a') - 1;
            }

        }
       */






        return $data = [$horas_reales, $dias];
    }


}
