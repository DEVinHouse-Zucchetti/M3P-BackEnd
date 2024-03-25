<?php

namespace App\Http\Services\StudentMeals;

use App\Http\Repositories\StudentMealsRepository;
use Illuminate\Support\Facades\Auth;

class GetPlansService
{
    private $studentMealsRepository;

    public function __construct(StudentMealsRepository $studentMealsRepository)
    {
        $this->studentMealsRepository = $studentMealsRepository;
    }

    public function handle()
    {
        $userId = Auth::user()->id;
        return $this->studentMealsRepository->getPlans($userId);
    }
}
