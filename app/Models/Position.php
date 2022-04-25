<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Position extends Model
{
    use HasFactory;
    protected $table = "positions";
    protected $guarded = [""];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
