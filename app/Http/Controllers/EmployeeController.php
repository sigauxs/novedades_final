<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Notification;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;


use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function show($id)
    {
        $notifications = Notification::where('employee_id',$id)->get();
        $employee = Employee::find($id);
        return view('employees.show',compact('notifications','employee'));
    }

    public function createPDF(Request $request){
        //Recuperar todos los productos de la db
        Notification::where('employee_id',$request->id)->paginate(5);
        $employee = Employee::find($request->id);
        $notifications = Notification::paginate(10);
        $pdf = PDF::loadView('employees.reportepdf', compact('employee','notifications'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream();
       
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
