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
                           ->where('identification',$identification)
                           ->select('*')
                           ->get();

       if($employee_filter->isEmpty()){

        return redirect()->action(
            [ApplicationFormController::class, 'index']
        )->with('error', 'El usuario no existe');


       }else{

       $center_costs = $this->center($employee_filter[0]->center_cost_id);  
       $type_notifications = $this->type_notification();
       $employee = $this->employee($employee_filter[0]->identification);
       $bosses = $this->bosses($employee_filter[0]->center_cost_id);
       $types = $this->type_identification();
                   
       return view('applicationForms.create',compact('center_costs','type_notifications','employee','bosses','types'));

       }              
       
    }


    public function store(StoreNotificationRequest $request)
    {


        $request->validated();

        $notification =  new Notification();

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
        $notification->total_days = $this->diasTrabajados((string)$request->started_date,(string)$request->finish_date)[1];
        $notification->total_hours = $this->diasTrabajados((string)$request->started_date,(string)$request->finish_date)[0]; 
        $notification->observation = $request->observation;
        $notification->support = $request->support;
      
        
        if($notification->save()){
            return redirect()->action(
                [ApplicationFormController::class, 'show'], ['applicationForm' => $notification->id ]
            );
        }

       
       //return redirect()->route('applicationForms.show',compact('notification'))->with('success', 'Novedad creada');

       //return redirect('/applicationsForms/{$notification}');
        
    }

   
    public function show($id)
    {
        $applicationForm =  Notification::find($id);
        return view('applicationForms.show',compact('applicationForm'));
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


    public function summary(){


        $total_horas_mensuales = DB::table('notifications')->select('*')->whereMonth('started_date',9)->sum('total_hours');
        $tiempo_perdidos_por_enfermades = "";
        return view('applicationForms.statisticsNotification');
    }


    /* Menu desplegado de centro de costo */

    public function center($center_cost_id){
        return CenterCost::where('id',$center_cost_id)->pluck('name', 'id');
    }

    public function type_notification(){
        return NotificationType::select('name','id')->orderBy('name','asc')->pluck('name','id');
    }

    public function employee($identification){
        return Employee::where('identification',$identification)->where('status',true)->select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
    }

    public function bosses($center_cost_id){
        return Boss::where('center_cost_id', $center_cost_id)->pluck('fullname', 'id');
    }

    public function type_identification(){
        return IdentificationType::where('id',1)->pluck('name','id');
    }


    public function diasTrabajados($inicio,$final){

        $data = [];
        
        $datetimeStart = new \DateTime($inicio);
        $datetimeFinish = new \DateTime($final);
        
        $break_time_start = "12:00";
        $break_time_final = "12:59";
        
        $interval = $datetimeStart->diff($datetimeFinish);
        
        $fecha_inicio_acomparar = $datetimeStart->format('Y-m-d');
        $fecha_final_acomparar = $datetimeFinish->format('Y-m-d');
        
        $horas_descanso_acumulada = 0;
        $horas_reales= 0;
        $horas_transcurridas = [];
        $countWeekend = 0;
        $dias = 0;
        
        if($fecha_final_acomparar == $fecha_final_acomparar){
        
            $inicio_recorrido = $datetimeStart->format('Y-m-d H:i:s');
            $final_recorrido = $datetimeFinish->format('Y-m-d H:i:s');
        
            $date_obj = new \DateTime($inicio_recorrido);
            $date_incr = $inicio_recorrido;
            $incr = 1;
            
        
            while($date_incr < $final_recorrido) {
                $date_incr = $date_obj->format('Y-m-d H:i:s');
                $time = $date_obj->format('H:i');  
                $date_obj->modify('+'.$incr.' minutes');
            
                array_push($horas_transcurridas,$time);
            
               if($time == $break_time_start || $time == $break_time_final){
                  $horas_descanso_acumulada+=1;
               }
                         
            }
        
            
            if($horas_descanso_acumulada == 2){
               $horas_reales = (int)$interval->format('%H') - 1; 
            }else {
                $hora =(int)$interval->format('%H');   
                $horas_reales =  $hora;
            }
            
            $dias = 1;
        }
        
        if($fecha_inicio_acomparar != $fecha_final_acomparar){
        
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
        
        return $data = [$horas_reales,$dias];
        
        
    }
}
