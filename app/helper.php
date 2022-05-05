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
       $dias_total+=1; 
       }
      
      return (int)$dias_total;


    

        
       /*
        if(){}

        $days = Carbon::parse("2022-05-04 07:00:00")->floatDiffInDays("2022-05-04 17:00:00");
        $days_f = Carbon::parse("2022-05-04 17:00:00");
        $days_b =  
        $total =
        $hour = Carbon::parse("2022-05-04 07:00:00")->floatDiffInHours("2022-05-04 17:00:00");
        return $hour - 2;*/
     }




    function current_user()
    {
        return auth()->user();
    }



?>
