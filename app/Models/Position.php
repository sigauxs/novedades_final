<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

use App\Models\Employee;

class Position extends Model
{
    use HasFactory;
    protected $table = "positions";
    protected $guarded = [""];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

