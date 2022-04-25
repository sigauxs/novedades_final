<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notification;

class Boss extends Model
{
    use HasFactory;
    protected $table = "bosses";
    protected $guarded = [''];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
