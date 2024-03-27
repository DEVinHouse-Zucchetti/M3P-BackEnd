<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WorkoutController extends Controller
{
    use HttpResponses;

    public function index()
    {
        try {

            $workouts = Workout::all();
            return $workouts;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function workoutsByStudent($studentId)
    {
        $authenticatedUserId = Auth::id();
        if ($authenticatedUserId != $studentId) {
            return $this->response('Você não tem permissão para acessar esses treinos', Response::HTTP_FORBIDDEN);
        }

        $workouts = Workout::select('workouts.*', 'exercises.description')
            ->join('exercises', 'workouts.exercise_id', '=', 'exercises.id')
            ->where('workouts.student_id', $studentId)
            ->orderBy('created_at')
            ->get();

        $formattingWorkouts = [
            'student_id' => $studentId,
            'name' => Auth::user()->name,
            'workouts' => []
        ];

        $weekDays = ['SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO'];
        foreach ($weekDays as $day) {
            $formattingWorkouts['workouts'][$day] = [];
        }

        foreach ($workouts as $workout) {
            $day = $workout->day;

            $formattingWorkouts['workouts'][$day][] = [
                'description' => $workout->description,
                'repetitions' => $workout->repetitions,
                'weight' => $workout->weight,
                'break_time' => $workout->break_time,
                'observations' => $workout->observations,
                'time' => $workout->time,
                'created_at' => $workout->created_at,
            ];
        }

        return $this->response('Listagem de treinos realizada com sucesso', Response::HTTP_OK, $formattingWorkouts);
    }
}