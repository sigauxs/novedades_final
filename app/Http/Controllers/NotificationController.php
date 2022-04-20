<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/* Models */

Use App\Models\CenterCost;
use App\Models\Employee;
use App\Models\IdentificationType;
use App\Models\Boss;
use App\Models\NotificationType;
use App\Models\Position;

use Illuminate\Support\Facades\DB;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
