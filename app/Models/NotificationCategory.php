<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\NotificationType;

class NotificationCategory extends Model
{
    use HasFactory;

    protected $guarded = [""];
    protected $table = "notification_categories";

    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class);
    }
}
