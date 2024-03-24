<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use DatabaseTransactions;

    private $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginAndGetToken();
    }

    public function loginAndGetToken()
    {
        $user = User::where('email', 'maria_recepcao@gmail.com')->first();
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);
        $this->token = $response->json('token');
    }

    public function testAuthorizedAccess()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/students');
        $response->assertStatus(200);
    }

    public function testFilterByName()
    {
        $name = 'Arthur';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/students?name=' . $name);
        $response->assertStatus(200);
    }
    
    public function testFilterByEmail()
    {
        $email = 'arthur@gmail.com';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/students?email=' . $email);
        $response->assertStatus(200);
    }
    
    public function testFilterByCpf()
    {
        $cpf = '12345678990';
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/students?cpf=' . $cpf);
        $response->assertStatus(200);
    }

    public function testFilterWithoutParams()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->getJson('/api/students');
        $response->assertStatus(200);
    }
}
