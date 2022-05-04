<?php

use Carbon\Carbon;

     function diffBusinessHours(){
        $days = Carbon::parse("2022-05-04 07:00:00")->floatDiffInDays("2022-05-04 17:00:00");
        $days_b =  Carbon::parse("2022-05-04 07:00:00")->format('d');
        $days_f = Carbon::parse("2022-05-04 17:00:00")->format('d');
        $hour = Carbon::parse("2022-05-04 07:00:00")->floatDiffInHours("2022-05-04 17:00:00");
        return $days." ".$hour. " " .$days_b ." ".$days_f;
     }




    function current_user()
    {
        return auth()->user();
    }



?>