<?php

namespace App\Http\Controllers;

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

class NotificationController extends Controller
{

    public function index()
    {
        return view('notifications.index');
    }

  
    public function create(){

        $center_costs = CenterCost::all()->pluck('name','id');
        $employees = Employee::select(DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
        $types = IdentificationType::all()->pluck('name','id');
        $positions = Position::all()->pluck('name','id');
        $bosses = Boss::all()->pluck('full_name','id');
        $notifications = NotificationType::all()->pluck('name','id');


        /*$fechaEmision = Carbon::parse($req->input('fecha_emision'));
         $fechaExpiracion = Carbon::parse($req->input('fecha_expiracion'));
         $diasDiferencia = $fechaExpiracion->diffInDays($fechaEmision);*/

        return view('notifications.create', compact('center_costs','employees','types','positions','bosses','notifications'));
    }

    
    public function store(Request $request)
    {

        $notification = $request->all();
        $notification_object = (object)$notification;

        $fechaInicio = Carbon::parse($notification_object->started_date);
        $fechafinalizacion = Carbon::parse($notification_object->finish_date);
        $notification_object->total_days = $fechaInicio->diffInDays($fechafinalizacion);
        $notification_object->total_hours = $fechaInicio->floatDiffInHours($fechafinalizacion);

        $notification_array = (array)$notification_object;

        

       $notification = Notification::create($notification_array);

        return redirect()->route('notifications.show', $notification );
    }


    public function show(Notification $notification)
    {
        $notification = Notification::find($notification->id);
        return view('notifications.show',compact('notification'));
    }

  
    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        
    }

    
    public function destroy($id)
    {
        
    }
}
