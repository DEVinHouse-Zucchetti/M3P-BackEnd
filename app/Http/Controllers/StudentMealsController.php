<?php

namespace App\Http\Controllers;

use App\Http\Services\StudentMeals\GetPlansService;
use App\Http\Services\StudentMeals\GetScheduleService;
use App\Models\MealPlans;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMealsController extends Controller
{
    use HttpResponses;

    public function index(GetPlansService $getPlansService){

        $plans = $getPlansService->handle();
        if (!$plans) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        return $plans;
    }

    public function show(GetScheduleService $getScheduleService, $id){
        $schedule = $getScheduleService->handle($id);
        if (!$schedule) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        return $schedule;
    }

}
