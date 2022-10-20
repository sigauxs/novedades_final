<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class CenterCost extends Model
{
    use HasFactory;
    protected $table = "center_costs";
    protected $guarded = [''];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
