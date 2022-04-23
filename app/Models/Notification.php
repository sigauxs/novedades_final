<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Notification extends Model
{
    use HasFactory;

    protected $guarded = [""];
    protected $table = "notifications";

    public function center_costs(){
        return $this->hasOne(Phone::class);
    }

    public function setStartedDateAttribute($value) 
{    
    $this->attributes['started_date'] = Carbon::parse($value); 
}


}
