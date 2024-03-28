<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Student;
use App\Models\File;
use App\Models\StudentDocument;
use App\Http\Services\File\CreateFileService;
use App\Http\Controllers\StudentDocumentController;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response;

class StudentDocumentControllerTest extends TestCase
{
    use WithFaker;

    public function testStoreMethod()
    {
        $file = UploadedFile::fake()->create('document.pdf');

        $createFileServiceMock = $this->getMockBuilder(CreateFileService::class)
            ->disableOriginalConstructor()
            ->getMock();

        $createFileServiceMock->expects($this->once())
            ->method('handle')
            ->willReturn([
                'id' => 1,
                'name' => 'file.pdf',
                'size' => 1024,
                'mime' => 'pdf',
                'url' => 'http://s3-testing.com/path/to/file.pdf'
            ]);

        $this->app->instance(CreateFileService::class, $createFileServiceMock);

        $student = Student::factory()->create();

        $response = $this->postJson(route('students.documents.store', ['id' => $student->id]), [
            'title' => $this->faker->sentence,
            'file_id' => 1,
            'document' => $file,
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertDatabaseHas('student_documents', [
            'title' => $response['document']['title'],
            'file_id' => 1,
            'student_id' => $student->id,
        ]);
    }
}
