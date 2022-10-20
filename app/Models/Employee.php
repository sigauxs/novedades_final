<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $guarded = [''];
     
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function position(){
        return $this->hasOne(Position::class,'id','position_id');
    }

    public function centercost(){
        return $this->hasOne(CenterCost::class,'id','center_cost_id');
    }

}
