<?php

use Carbon\Carbon;

use App\Models\NotificationType;

     function diffBusinessHours($fecha_inicio,$fecha_final){
       
       $f_inicio_d = $fecha_inicio->format("d");
       $f_final_d =  $fecha_final->format("d");

       $fecha_final_completa =  $fecha_final;
       $fecha_inicio_completa = $fecha_inicio;

       if($f_inicio_d  == $f_final_d){
        $dias_total =  $fecha_final_completa->floatDiffInDays($fecha_inicio_completa);
        $dias_total+=1;        
       }else{
        $dias_total =  $fecha_final_completa->floatDiffInDays($fecha_inicio_completa);
       
       }
      
      return (int)$dias_total;
   
  
     }




    function current_user()
    {
        return auth()->user();
    }

    function recorrer(){

        /*$comienzo = new DateTime('19-03-2019');
        $final = new DateTime('22-03-2019');
        // Necesitamos modificar la fecha final en 1 día para que aparezca en el bucle
        $final = $final->modify('+1 day');
        
        $intervalo = DateInterval::createFromDateString('1 day');
        $periodo = new DatePeriod($comienzo, $intervalo, $final);
        
        foreach ($periodo as $dt) {
           $dt = Carbon::parse($dt->format("Y-m-d\n"))->isWeekend();
           echo $dt."<br/>";
        }*/

        /*function number_of_working_days($from, $to) {
            $workingDays = [1, 2, 3, 4, 5, 6]; # date format = N (1 = Monday, ...)
            $holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays
        
            $from = new DateTime($from);
            $to = new DateTime($to);
            $to->modify('+1 day');
            $interval = new DateInterval('P1D');
            $periods = new DatePeriod($from, $interval, $to);
        
            $days = 0;
            foreach ($periods as $period) {
                if (!in_array($period->format('N'), $workingDays)) continue;
                if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
                if (in_array($period->format('*-m-d'), $holidayDays)) continue;
                $days++;
            }
            
            return $days;
        }*/


      
    }



?>
