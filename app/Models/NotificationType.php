<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class NotificationType extends Model
{
    use HasFactory;
    protected $table = "notifications_types";
    protected $guarded = [''];


    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
