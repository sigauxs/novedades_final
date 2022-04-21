<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [""];
    protected $table = "notifications";

    public function center_costs(){
        return $this->hasOne(Phone::class);
    }

}
