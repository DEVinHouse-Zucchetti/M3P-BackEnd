<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlanSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'meal_plan_id',
        'hour',
        'title',
        'description',
        'day'
    ];

}