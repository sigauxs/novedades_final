<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Notification;
use App\Models\IdentificationType;
use App\Models\Position;
use App\Models\CenterCost;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Requests\StoreEmployeeRequest;


class EmployeeController extends Controller
{




    public $filters = [

        'b_fecha_inicio' => '',
        'b_fecha_final' => '',
        'id' => '',
        'mes' => ''
    ];

    public function index()
    {

            return view('employees.index');
    }


    public function create()
    {

        $status = ['1' => 'Activo','0' => 'Inactivo'];
        $type_identification = $this->type_identification();
        $positions = $this->positions();
        $centerCost = $this->centerCost();

        return view('employees.create', compact('type_identification','positions','centerCost','status'));
    }


    public function store(StoreEmployeeRequest $request)
    {

        $employee = Employee::create($request->all());

       return redirect()->route('employees.show',compact('employee'))->with('success', 'Empleado creado exitosamente');
    }


    public function show($id,Request $request)
    {



        $employee = Employee::find($id);



        $b_fecha_inicio = $request->b_fecha_inicio;
        $b_fecha_final = $request->b_fecha_final;
        $id = $request->id;



        if(isset($b_fecha_inicio)&& isset($b_fecha_final)){

          $notifications = Notification::where('employee_id',$employee->id)
                          ->whereDate('started_date','>=',$b_fecha_inicio)->whereDate('started_date','<=',$b_fecha_final)->paginate(30);

          $sumaDias      = Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                                                           ->whereDate('started_date','<=',$b_fecha_final)->paginate(30)->sum('total_days');

          $sumaHoras     = Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                                                           ->whereDate('started_date','<=',$b_fecha_final)->paginate(30)->sum('total_hours');



        }else{

            $notifications = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->paginate(30);
            $sumaDias      = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->paginate(30)->sum('total_days');
            $sumaHoras     = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->paginate(30)->sum('total_hours');
        }

        return view('employees.show',compact('notifications','employee','sumaDias','sumaHoras','b_fecha_inicio','b_fecha_final'));
    }

    public function createPDF(Request $request){

        $employee = Employee::find($request->id);
        $b_fecha_inicio = $request->b_fecha_inicio;
        $b_fecha_final = $request->b_fecha_final;

       $horas_planificados = 205.7;


        $notifications =  Notification::where('employee_id',$employee->id)
                                      ->whereDate('started_date','>=',$b_fecha_inicio)
                                      ->whereDate('started_date','<=',$b_fecha_final)
                                      ->orderBy('created_at', 'desc')->get();

        $sumaDias      = Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                      ->whereDate('started_date','<=',$b_fecha_final)->get()->sum('total_days');

        $sumaHoras     =  Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                      ->whereDate('started_date','<=',$b_fecha_final)->get()->sum('total_hours');


         $eps          =  Notification::where('employee_id',$employee->id)
                                        ->whereDate('started_date','>=',$b_fecha_inicio)
                                        ->whereDate('started_date','<=',$b_fecha_final)
                                        ->where('notifications_type_id',1)
                                        ->count();

         $arl         =  Notification::where('employee_id',$employee->id)
                                        ->whereDate('started_date','>=',$b_fecha_inicio)
                                        ->whereDate('started_date','<=',$b_fecha_final)
                                        ->where('notifications_type_id',2)
                                        ->count();


         $vacaciones  =  Notification::where('employee_id',$employee->id)
                                        ->whereDate('started_date','>=',$b_fecha_inicio)
                                        ->whereDate('started_date','<=',$b_fecha_final)
                                        ->where('notifications_type_id',3)
                                        ->get()->sum('total_days');


         $retrasos = DB::table('notifications as n')->where('employee_id',$employee->id)
         ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
         ->join('notification_categories as ct','nt.notification_category_id','=','ct.id')
         ->where('ct.id','=',10)
         ->whereDate('started_date','>=',$b_fecha_inicio)
         ->whereDate('started_date','<=',$b_fecha_final)
         ->count();

         $ausentimos = Notification::where('employee_id',$employee->id)
                                    ->whereMonth('started_date', $b_fecha_inicio)
                                    ->get()->sum('total_hours');

        $ausentimos =  $ausentimos / $horas_planificados;





        $pdf = PDF::loadView('employees.reportepdf', compact('retrasos','vacaciones','eps','arl','sumaHoras','sumaDias','employee','notifications','b_fecha_final','b_fecha_inicio'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('mypdf.pdf',array('Attachment'=>0));

    }

    public function allPDF(Request $request){

        $employee = Employee::find($request->id);
        $mes = $request->mes;

        $notifications =  Notification::where('employee_id',$request->id)->orderBy('created_at', 'desc')->get();

        $sumaHoras = Notification::where('employee_id',$request->id)->sum('total_hours');
        $sumaDias = Notification::where('employee_id',$request->id)->sum('total_days');


        $eps=  "";

$arl         =  "";


$vacaciones  =  "";


$retrasos = "";
        $pdf = PDF::loadView('employees.reportepdf', compact('retrasos','vacaciones','eps','arl','sumaHoras','sumaDias','employee','notifications','mes'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('mypdf.pdf',array('Attachment'=>0));

    }



     public function edit($id)
    {

        $employee = Employee::find($id);
        $status = ['1' => 'Activo','0' => 'Inactivo'];
        $type_identification = $this->type_identification();
        $positions = $this->positions();
        $centerCost = $this->centerCost();

        return view('employees.edit', compact('employee','type_identification','positions','centerCost','status'));

    }


    public function update(Request $request, $id)
    {
        $employee =  Employee::find($id);
        $employee->update($request->all());
        return redirect()->route('employees.show',compact('employee'))->with('success', 'Empleado actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function type_identification(){
        return IdentificationType::all()->pluck('name','id');
    }

    public function positions(){
        return Position::all()->pluck('name','id');
    }


    public function centerCost(){
        return CenterCost::all()->pluck('name','id');
    }

}
