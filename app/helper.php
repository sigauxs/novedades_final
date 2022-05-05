<?php

use Carbon\Carbon;

use App\Models\NotificationType;

     function diffBusinessHours(){

        $n = NotificationType::where('id',1)->select('id')->get();

        $days = Carbon::parse("2022-05-04 07:00:00")->floatDiffInDays("2022-05-04 17:00:00");
        $days_f = Carbon::parse("2022-05-04 17:00:00");
        $days_b =  Carbon::parse("2022-05-04 07:00:00");
         $total =
        $hour = Carbon::parse("2022-05-04 07:00:00")->floatDiffInHours("2022-05-04 17:00:00");
        return $hour - 2;
     }




    function current_user()
    {
        return auth()->user();
    }



?>
