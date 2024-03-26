<?php

namespace Tests\Feature;

use App\Http\Services\Student\PasswordGenerationService;
use App\Http\Services\Student\SendCredentialsStudentEmail;
use App\Models\Student;
use App\Models\User;

use Illuminate\Http\Request;
use Tests\TestCase;

class StudentTest extends TestCase
{
    public function test_receptionist_token_was_generated(): void
    {
        $receptionist = User::find(2);
        $credentials = [
            'email' => $receptionist->email,
            'password' => '12345678',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200);
    }

    public function test_request_body_all(): void
    {
        $body = [
            'name' => 'João da Silva',
            'email' => 'joao@example.com',
            'cpf' => '024.892.560-26',
            'date_birth' => '1945-01-24',
            'contact' => '980579171',
            'cep' => '96810174',
            'street' => 'Rua vinte e oito de setembro',
            'state' => 'RS',
            'neighborhood' => 'Centro',
            'city' => 'Santa cruz do sul',
            'number' => '642',
        ];
        $request = new Request($body);

        $result = $request->all();

        $this->assertEquals($body, $result);
    }

    public function test_password_is_being_generated(): void
    {

        $passwordGenerationService = new PasswordGenerationService();

        $password = $passwordGenerationService->handle();

        $this->assertIsString($password);
        $this->assertGreaterThanOrEqual(8, strlen($password));
    }

    public function test_credentials_are_being_sent_by_email(): void
    {
        $student = new Student([
            'name' => 'João da Silva',
            'email' => 'joao@example.com',
        ]);

        $password = 'senha123';

        $emailServiceMock = \Mockery::mock(SendCredentialsStudentEmail::class);

        $emailServiceMock->shouldReceive('handle')->with($student, $password)->once();

        $emailServiceMock->handle($student, $password);
    }
}
