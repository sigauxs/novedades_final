<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use App\Models\Notification;
use App\Models\IdentificationType;
use App\Models\Position;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Requests\StoreEmployeeRequest;


class EmployeeController extends Controller
{




    public $filters = [
        'mes' => '',
        'id' => '',
    ];

    public function index()
    {

            return view('employees.index');
    }

   
    public function create()
    {
        $type_identification = $this->type_identification();
        $positions = $this->positions();
        $centerCost = $this->centerCost();

        return view('employees.create', compact('type_identification','positions','centerCost'));
    }

 
    public function store(StoreEmployeeRequest $request)
    {
        
        
    }

   
    public function show($id,Request $request)
    {

        $date = Carbon::now();
        $date = $date->format('m');
        $month = collect(today()->startOfMonth()->subMonths(12)->monthsUntil(today()->startOfMonth()))->mapWithKeys(fn ($month) => [$month->month => $month->monthName]);

        $request->mes ? $this->filters['mes'] = $request->mes : $this->filters['mes'] = $date;

        $this->filters['id'] = $id;
        $mes = $this->filters['mes'];

         $notifications = Notification::query()
         ->when($this->filters,function($query){
            return $query
            ->where('employee_id',$this->filters['id'])
            ->whereMonth('started_date',$this->filters['mes']);
        })
         ->orderBy('created_at', 'desc')->get();


        $employee = Employee::find($id);
        $sumaDias =  Notification::query()
        ->when($this->filters,function($query){
           return $query
           ->where('employee_id',$this->filters['id'])
           ->whereMonth('started_date',$this->filters['mes']);
         })->sum('total_days');
        $sumaHoras =   Notification::query()
        ->when($this->filters,function($query){
           return $query
           ->where('employee_id',$this->filters['id'])
           ->whereMonth('started_date',$this->filters['mes']);
         })->sum('total_hours');
        return view('employees.show',compact('notifications','employee','sumaDias','sumaHoras','month','mes'));
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
        
    }

    
    public function update(Request $request, $id)
    {
        //
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
        return Position::all()->pluck('name','id');
    }

}
