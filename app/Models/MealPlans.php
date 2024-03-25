<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlans extends Model
{

    public function mealPlansSchedule()
    {
        return $this->hasMany(MealPlansSchedule::class, 'meal_plan_id');
    }
}
