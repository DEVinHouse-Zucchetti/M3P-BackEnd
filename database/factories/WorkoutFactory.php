<?php
namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorkoutFactory extends Factory
{
    protected $model = Workout::class;

    public function definition(): array
    {
        // Obtenha um ID de usuário aleatório


        return [

            'repetitions' => $this->faker->numberBetween(1, 20),
            'weight' => $this->faker->randomFloat(2, 1, 1000),
            'break_time' => $this->faker->numberBetween(30, 600), // in seconds
            'day' => $this->faker->randomElement(['SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO']),
            'observations' => $this->faker->text(),
            'time' => $this->faker->numberBetween(60,3600)
        ];
    }
}