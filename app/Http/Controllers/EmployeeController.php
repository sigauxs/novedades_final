<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Notification;
use App\Models\IdentificationType;
use App\Models\Position;
use App\Models\CenterCost;

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
                          ->whereDate('started_date','>=',$b_fecha_inicio)->whereDate('started_date','<=',$b_fecha_final)->get();
                         
          $sumaDias      = Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                                                           ->whereDate('started_date','<=',$b_fecha_final)->get()->sum('total_days');

          $sumaHoras     = Notification::where('employee_id',$employee->id)->whereDate('started_date','>=',$b_fecha_inicio)
                                                                           ->whereDate('started_date','<=',$b_fecha_final)->get()->sum('total_hours');


        }else{

            $notifications = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->take(10)->get();
            $sumaDias      = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->take(10)->get()->sum('total_days');
            $sumaHoras     = Notification::where('employee_id',$employee->id)->orderBy('created_at', 'desc')->take(10)->get()->sum('total_hours');
        }

        return view('employees.show',compact('notifications','employee','sumaDias','sumaHoras','b_fecha_inicio','b_fecha_final'));
    }

    public function createPDF(Request $request){

        $employee = Employee::find($request->id);
        $mes = $request->mes;

        $notifications =  Notification::where('employee_id',$request->id)->whereMonth('started_date',$mes)
        ->orderBy('created_at', 'desc')->get();

        $sumaHoras = Notification::where('employee_id',$request->id)->whereMonth('started_date',$mes)->sum('total_hours');
        $sumaDias = Notification::where('employee_id',$request->id)->whereMonth('started_date',$mes)->sum('total_days');

        $pdf = PDF::loadView('employees.reportepdf', compact('sumaHoras','sumaDias','employee','notifications','mes'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('mypdf.pdf',array('Attachment'=>0));

    }

    public function allPDF(Request $request){

        $employee = Employee::find($request->id);
        $mes = $request->mes;

        $notifications =  Notification::where('employee_id',$request->id)->orderBy('created_at', 'desc')->get();

        $sumaHoras = Notification::where('employee_id',$request->id)->sum('total_hours');
        $sumaDias = Notification::where('employee_id',$request->id)->sum('total_days');

        $pdf = PDF::loadView('employees.reportepdf', compact('sumaHoras','sumaDias','employee','notifications','mes'))->setOptions(['defaultFont' => 'sans-serif']);
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
