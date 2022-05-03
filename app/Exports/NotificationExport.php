<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class NotificationExport implements FromCollection ,WithHeadings,WithMapping
{
    public $administrativo = 6;
    public $operacional = 1;
    public $do = 8;

    public $p_visor = 2;
    public $p_admin = 1;
    public $c_admin = 9;

    public function collection()
    {




        $user_model = Auth::user();


        $date = Carbon::now();
        $date = $date->format('m');

        if($user_model->center_cost_id == $this->c_admin || ($user_model->center_cost_id == $this->administrativo AND $user_model->profile_id == $this->p_admin ) || ($user_model->center_cost_id == $this->do AND $user_model->profile_id == $this->p_visor) ){

        $notification =  DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','em.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->whereMonth('started_date',$date)
        ->select('idt.name as tipo_id','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as center_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total_dias','total_hours as total_horas','business_days as dias_laborales','observation as observacion','support as soporte')
        ->orderBy('started_date','desc')
        ->get();

        }else{
        $notification =  DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','em.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->where('n.user_id',$user_model->id)->whereMonth('started_date',$date)
        ->select('idt.name as tipo_id','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as center_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total_dias','total_hours as total_horas','business_days as dias_laborales','observation as observacion','support as soporte')
        ->orderBy('started_date','desc')
        ->get();
       }


        return $notification;


    }


    public function headings(): array
    {
        return [
            'Tipo de identificacion',
            'Identificacion',
            'Nombres',
            'Apellidos',
            'Cargos',
            'Centro de costos',
            'Jefe de inmediato',
            'Tipo de novedad',
            'Fecha de inicio',
            'Fecha de finalizacion',
            'Total de dias',
            'Total de horas por fechas',
            'Horas No laborales',
            'Observaciones',
            'Soporte'
        ];
    }

    public function map($notification): array
    {



        return [

            $notification->tipo_id,
            $notification->identificacion,
            $notification->nombres,
            $notification->apellidos,
            $notification->cargo,
            $notification->center_costo,
            $notification->jefe_inmediato,
            $notification->tipo_novedad,
            Carbon::parse($notification->started_date)->translatedFormat('j F, Y h:i:s A'),
            Carbon::parse($notification->finish_date)->translatedFormat('j F, Y h:i:s A'),
            $notification->total_dias,
            $notification->total_horas,
            $notification->dias_laborales,
            $notification->observacion,
            $notification->soporte ? 'Si' : 'No'





        ];
    }


}
