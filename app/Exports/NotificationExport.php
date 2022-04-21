<?php

namespace App\Exports;

use App\Models\Notification;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Support\Facades\DB;

class NotificationExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $notification =  DB::table('notifications as n')->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')->join('employees as em', 'n.employee_id','=','em.id')->join('positions as pos','n.position_id','=','pos.id')->join('center_costs as cc','n.center_cost_id','=','cc.id')->join('bosses as boss','n.boss_id','=','boss.id')->join('notifications_types as nt','n.notifications_type_id','=','nt.id')->select('idt.name as tipo de identificacion','em.identification as identificacion','em.first_name','em.last_name','pos.name as cargo','cc.name as centro de costo','boss.full_name as jefe inmediato','nt.name as tipo de novedad',DB::raw("CONCAT(LEFT((started_date),10),' ',TIME_FORMAT(RIGHT((started_date),8),'%r')) AS 'fecha de inicio' "),DB::raw("CONCAT(LEFT((finish_date),10),' ',TIME_FORMAT(RIGHT((finish_date),8),'%r')) AS 'fecha de ‌finalizacion' "),'total_days as total de dias','total_hours as total de horas','observation as observacion')->get();

        return $notification;
         /*
        $notification = DB::table('notifications as n')
                            ->join('identification_types as idt', 'n.type_identification_id', '=', 'idt.id')
                            ->join('employees as em', 'n.employee_id','=','em.id')
                            ->join('positions as pos','n.position_id','=','pos.id')
                            ->join('center_costs as cc','n.center_cost_id','=','cc.id')
                            ->join('bosses as boss','n.boss_id','=','boss.id')
                            ->join('notifications_types as nt','n.notifications_type_id','=','nt.id')
                            ->select('idt.name as tipo de identificacion','em.identification as identificacion','em.first_name','em.last_name','pos.name as cargo','cc.name','boss.full_name as jefe inmediato','nt.name as tipo de novedad','started_date as Fecha de inicio','finish_date as Fecha de finalizacion','total_days as total de dias','total_hours as total de horas','observation as observacion')->get();*/
        /*return $notification;*/
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
            'Total de horas',
            'Observaciones'
        ];
    }
}
