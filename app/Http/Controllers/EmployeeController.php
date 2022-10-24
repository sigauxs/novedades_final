<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notification;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        //Recuperar todos los productos de la db

        $employee = Employee::find($request->id);
        $notifications =  Notification::where('employee_id',$request->id)->orderBy('created_at', 'desc')->get();
        $pdf = PDF::loadView('employees.reportepdf', compact('employee','notifications'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('mypdf.pdf',array('Attachment'=>0));

    }

    public function imprimirtest(Employee $employee){
        $employee = Employee::find($employee->id);
        $pdf = PDF::loadView('employees.test',compact('employee'));
        return $pdf->download('archivo-pdf.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
