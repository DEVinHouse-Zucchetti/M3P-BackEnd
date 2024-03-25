<?php

namespace App\Http\Services\StudentMeals;

use App\Http\Repositories\StudentMealsRepository;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GetScheduleService
{
    use HttpResponses;
    private $studentMealsRepository;

    public function __construct(StudentMealsRepository $studentMealsRepository)
    {
        $this->studentMealsRepository = $studentMealsRepository;
    }

    public function handle($id)
    {
        $userName = Auth::user()->name;
        $userId = Auth::user()->id;
        $student = $this->studentMealsRepository->getSchedule($id, $userId);

        if(!$student) return $this->error('Dado não encontrado', Response::HTTP_NOT_FOUND);
        $array = $student->mealPlansSchedule;

         $mealPlanSchedule = [
            'student_id' => $userId,
            'student_name' => $userName,
            'meal_plans' => [
                "SEGUNDA" => [],
                "TERÇA" => [],
                "QUARTA" => [],
                "QUINTA" => [],
                "SEXTA" => [],
                "SÁBADO" => [],
                "DOMINGO" => [],
            ]
        ];
          foreach ($array as $item) {
            $mealPlanSchedule['meal_plans'][$item->day][] = $item;
        }
        return $mealPlanSchedule;

    }
}
