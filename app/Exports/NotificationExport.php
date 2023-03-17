<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class NotificationExport implements FromCollection, WithHeadings, WithMapping
{
    public $administrativo = 6;
    public $operacional = 1;
    public $do = 8;

    public $p_visor = 2;
    public $p_admin = 1;
    public $c_admin = 9;

    public $f_inicio;
    public $f_final;
    public $category;


    public function __construct($inicio, $final, $category)
    {
        $this->f_inicio = $inicio;
        $this->f_final  = $final;
        $this->category = $category;
    }

    public function collection()
    {


        $user_model = Auth::user();


        $date = Carbon::now();
        $date = $date->format('m');



        if (!empty($this->f_inicio) &&  !empty($this->f_final) && !empty($this->category)) {

            $notification =  DB::table('notifications as n')
            ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
            ->join('employees as em', 'n.employee_id', '=', 'em.id')
            ->join('positions as pos', 'em.position_id', '=', 'pos.id')
            ->join('center_costs as cc', 'n.center_cost_id', '=', 'cc.id')
            ->join('bosses as boss', 'n.boss_id', '=', 'boss.id')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')->join('notification_categories as ct', 'nt.notification_category_id', '=', 'ct.id')
                ->where('ct.id', '=', $this->category)
                ->whereDate('started_date', '>=', $this->f_inicio)->whereDate('started_date', '<=', $this->f_final)
                ->select('idt.name as tipo_id', 'em.identification as identificacion', 'em.first_name as nombres', 'em.last_name as apellidos', 'pos.name as cargo', 'cc.name as center_costo', 'boss.fullname as jefe_inmediato', 'nt.name as tipo_novedad', 'started_date', 'finish_date', 'started_time', 'finish_time', 'total_days as total_dias', 'total_hours as total_horas', 'observation as observacion', 'support as soporte')
                ->orderBy('started_date', 'desc')
                ->get();

            return $notification;

        } else if (!empty($this->f_inicio) &&  !empty($this->f_final)) {
            $notification =  DB::table('notifications as n')
            ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
            ->join('employees as em', 'n.employee_id', '=', 'em.id')
            ->join('positions as pos', 'em.position_id', '=', 'pos.id')
            ->join('center_costs as cc', 'n.center_cost_id', '=', 'cc.id')
            ->join('bosses as boss', 'n.boss_id', '=', 'boss.id')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')->whereDate('started_date', '>=', $this->f_inicio)->whereDate('started_date', '<=', $this->f_final)
                ->select('idt.name as tipo_id', 'em.identification as identificacion', 'em.first_name as nombres', 'em.last_name as apellidos', 'pos.name as cargo', 'cc.name as center_costo', 'boss.fullname as jefe_inmediato', 'nt.name as tipo_novedad', 'started_date', 'finish_date', 'started_time', 'finish_time', 'total_days as total_dias', 'total_hours as total_horas', 'observation as observacion', 'support as soporte')
                ->orderBy('started_date', 'desc')
                ->get();

                return $notification;
        } else {
            $notification =  DB::table('notifications as n')
            ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
            ->join('employees as em', 'n.employee_id', '=', 'em.id')
            ->join('positions as pos', 'em.position_id', '=', 'pos.id')
            ->join('center_costs as cc', 'n.center_cost_id', '=', 'cc.id')
            ->join('bosses as boss', 'n.boss_id', '=', 'boss.id')
            ->join('notifications_types as nt', 'n.notifications_type_id', '=', 'nt.id')->select('idt.name as tipo_id', 'em.identification as identificacion', 'em.first_name as nombres', 'em.last_name as apellidos', 'pos.name as cargo', 'cc.name as center_costo', 'boss.fullname as jefe_inmediato', 'nt.name as tipo_novedad', 'started_date', 'finish_date', 'started_time', 'finish_time', 'total_days as total_dias', 'total_hours as total_horas', 'observation as observacion', 'support as soporte')
                ->orderBy('started_date', 'desc')
                ->get();

            return $notification;
        }


        /*if($user_model->center_cost_id == $this->c_admin || ($user_model->center_cost_id == $this->administrativo AND $user_model->profile_id == $this->p_admin ) || ($user_model->center_cost_id == $this->do AND $user_model->profile_id == $this->p_visor) ){

        $notification =  DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','em.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->select('idt.name as tipo_id','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as center_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','started_time','finish_time','total_days as total_dias','total_hours as total_horas','observation as observacion','support as soporte')
        ->orderBy('started_date','desc')
        ->get();

        // ->whereMonth('started_date',$date)
        }else{
        $notification =  DB::table('notifications as n')
        ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
        ->join('employees as em', 'n.employee_id','=','em.id')
        ->join('positions as pos','em.position_id','=','pos.id')
        ->join('center_costs as cc','n.center_cost_id','=','cc.id')
        ->join('bosses as boss','n.boss_id','=','boss.id')
        ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
        ->select('idt.name as tipo_id','em.identification as identificacion','em.first_name as nombres','em.last_name as apellidos','pos.name as cargo','cc.name as center_costo','boss.fullname as jefe_inmediato','nt.name as tipo_novedad','started_date','finish_date','total_days as total_dias','total_hours as total_horas','observation as observacion','support as soportes')
        ->orderBy('started_date','desc')
        ->get();

        // ->where('n.user_id',$user_model->id)->whereMonth('started_date',$date)
       }*/
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
            'Hora de inicio',
            'Fecha de finalizacion',
            'Hora de finalizacion',
            'Total de dias',
            'Total de horas por fechas',
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
            Carbon::parse($notification->started_date),
            $notification->started_time,
            Carbon::parse($notification->finish_date),
            $notification->finish_time,
            $notification->total_dias,
            $notification->total_horas,
            $notification->observacion,
            $notification->soporte ? 'Si' : 'No'


        ];
    }
}
