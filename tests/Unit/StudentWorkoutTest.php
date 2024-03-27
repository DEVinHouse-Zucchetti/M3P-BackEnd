<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StudentWorkoutTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testWorkoutsByStudent(): void
    {        
        $studentId = 6;    
        
        $user = User::factory()->create(['id' => $studentId]);    
        
        $this->actingAs($user);    
        
        $response = $this->get("/api/students/{$studentId}/workouts");      
        
        $response->assertStatus(200);
    }    

    public function testWorkoutsStudent(): void
    {        
        
        $studentId = 6; 
      
        $user = User::factory()->create(['id' => $studentId]);         
       
        $this->actingAs($user);    

        $response = $this->get("/api/students/{$studentId}/workouts");  

        $response->assertStatus(200);

        // Verificamos que la respuesta contenga los datos esperados
        $response->assertJsonStructure([
            'student_id',
            'name',
            'workouts' => [
                '*' => [
                    '*' => [
                        'description',
                        'repetitions',
                        'weight',
                        'break_time',
                        'observations',
                        'time',
                        'created_at'
                    ]
                ]
            ]
        ]);
    } 

    public function test_student_can_list_their_own_workouts()
    {
        $student = User::factory()->create(['profile_id' => 5]);
        $token = $student->createToken('@academia', ['get-workout'])->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/students/' . $student->id . '/workouts');
        $response->assertStatus(200);
    }

    public function test_student_can_not_list_workouts_from_another_student()
    {
        $student = User::factory()->create(['profile_id' => 5]);
        $anotherStudent = User::factory()->create(['profile_id' => 5]);
        $token = $student->createToken('@academia', ['get-workout'])->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('/api/students/' . $anotherStudent->id . '/workouts');
        $response->assertStatus(403);
    }

}