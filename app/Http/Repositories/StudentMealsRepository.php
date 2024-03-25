<?php

namespace App\Http\Repositories;
use App\Interfaces\StudentMealsRepositoryInterface;
use App\Models\File;
use App\Models\MealPlans;

class StudentMealsRepository implements StudentMealsRepositoryInterface {

    public function getPlans($userId) {
        return MealPlans::query()->where('student_id', $userId)->get();

    }

    public function getSchedule($id, $userId)
    {
        return MealPlans::query()->where('student_id', $userId)->where('id', $id)->with(['mealPlansSchedule' => function ($query) {
            $query->orderBy('hour');
        }])->first();
    }
}


