<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/* Models */

Use App\Models\CenterCost;
Use App\Models\IdentificationType;
Use App\Models\Employee;
Use App\Models\Position;
Use App\Models\Boss;
Use App\Models\NotificationType;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [""];
    protected $table = "notifications";

    public function Employee():HasOne {
            return $this->HasOne(Employee::class,'id','employee_id');
    }

        

    public function centerCost():HasOne{      
        return $this->hasOne(CenterCost::class,'id','center_cost_id');
    }

    public function position(){      
        return $this->hasOne(Position::class,'id','position_id');
    }

    public function boss():HasOne{
        return $this->hasOne(Boss::class,'id','boss_id');
    }

    public function notificationType():HasOne{
        return $this->hasOne(NotificationType::class,'id','notifications_type_id');
    }

   


}
