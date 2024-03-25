<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlansSchedule extends Model
{
    use HasFactory;
    protected $table = "meal_plans_schedule";

    public function mealPlans()
    {
        return $this->belongsTo(MealPlans::class);
    }
}
