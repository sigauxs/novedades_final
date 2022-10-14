<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;
Use App\Models\NotificationCategory;
use Illuminate\Database\Eloquent\Relations\HasOne;


class NotificationType extends Model
{
    use HasFactory;
    protected $table = "notifications_types";
    protected $guarded = [''];


    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function notificationCategory():HasOne{
        return $this->hasOne(NotificationCategory::class,'id','notification_category_id');
     }
}
