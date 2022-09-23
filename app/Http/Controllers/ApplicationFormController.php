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
        $notification->total_days = diffBusinessHours($fechaInicio,$fechafinalizacion);
        $notification->total_hours = $fechaInicio->floatDiffInHours($fechafinalizacion); 
        $notification->observation = $request->observation;
        $notification->support = $request->support;
        $notification->business_days = $notification->total_days * 8;
        
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
}
