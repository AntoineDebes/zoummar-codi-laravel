<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    
    public function plan_type(){
        return $this->belongsTo(PlanType::class, 'plan_types_id', 'id');
    }
}
