<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'maria_recepcao@gmail.com',
            'password' => '12345678',
        ]);

        $token = $response->json('data.token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/students', [
            'name' => 'Arthur',
            'cpf' => '12345678990',
            'email' => 'arthur@gmail.com',
        ]);

        $response->assertStatus(200);

        if ($response->getStatusCode() === 200) {
            $response->assertJsonCount(1); // Verifica se há 1 estudante na resposta
        } else {
            $response->assertJsonStructure(['error']);
        }

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'email',
                'contact',
                'cpf',
            ],
        ]);
    }
}
