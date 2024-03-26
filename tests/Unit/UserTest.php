<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_admin_can_login()
    {
        $response = $this->post('/api/login', [
            'email' => env("DEFAULT_EMAIL"),
            'password' => env("DEFAULT_PASSWORD")
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'message' => "Autorizado",
            'status' => Response::HTTP_OK,
            'data' => [
                "name" => true,
                "profile" => "ADMIN",
                "permissions" => true,
                "token" => true
            ]
        ]);
    }

    public function test_admin_can_not_login_with_invalid_credentials()
    {
        $response = $this->post('/api/login', [
            'email' => env("DEFAULT_EMAIL"),
            'password' => "1234567"
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED)->assertJson([
            'message' => "Não autorizado. Credenciais incorretas",
            'status' => Response::HTTP_UNAUTHORIZED
        ]);
    }

    public function test_admin_can_not_login_without_email()
    {
        $response = $this->post('/api/login', [
            'password' => env("DEFAULT_PASSWORD")
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $responseData = json_decode($response->getContent(), true);
        $this->assertEquals('The email field is required.', $responseData['message']);
    }

    public function test_admin_permissions_load_correct()
    {
        $response = $this->post('/api/login', [
            'email' => env("DEFAULT_EMAIL"),
            'password' => env("DEFAULT_PASSWORD")
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'data' => [
                'permissions' => [
                    'create-users',
                    'get-users',
                    'delete-users',
                    'update-users',
                    'admin-dashboard',
                ]
            ]
        ]);
    }

    public function test_recepcionista_permissions_load_correct()
    {
        $user = User::factory()->create(['profile_id' => 2, 'password' => '12345678']);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'data' => [
                'permissions' => [
                    'create-students',
                    'get-students',
                    'delete-students',
                    'update-students',
                    'create-documents-students',
                    'get-documents-students',
                    'get-avaliations'
                ]
            ]
        ]);
    }

    public function test_instrutor_permissions_load_correct()
    {
        $user = User::factory()->create(['profile_id' => 3, 'password' => '12345678']);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'data' => [
                'permissions' => [
                    'instrutor-dashboard',
                    'create-exercises',
                    'get-exercises',
                    'delete-exercises',
                    'get-students',
                    'create-workouts',
                    'get-workouts',
                    'delete-workouts',
                    'update-workouts'
                ]
            ]
        ]);
    }

    public function test_nutricionista_permissions_load_correct()
    {
        $user = User::factory()->create(['profile_id' => 4, 'password' => '12345678']);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'data' => [
                'permissions' => [
                    'create-avaliations',
                    'get-actives-students',
                    'get-avaliations',
                    'create-meal-plans',
                    'get-meal-plans'
                ]
            ]
        ]);
    }

    public function test_aluno_permissions_load_correct()
    {
        $user = User::factory()->create(['profile_id' => 5, 'password' => '12345678']);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => '12345678'
        ]);

        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'data' => [
                'permissions' => [
                    'get-workout',
                    'get-meal-plans'
                ]
            ]
        ]);
    }

    public function test_admin_can_logout()
    {
        $user = User::factory()->create(['profile_id' => 1]);

        $response = $this->actingAs($user)->post('/api/logout');

        $response->assertStatus(Response::HTTP_NO_CONTENT);
    }
}
