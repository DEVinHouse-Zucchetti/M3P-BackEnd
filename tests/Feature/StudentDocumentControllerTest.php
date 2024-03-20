<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\StudentDocument;

class StudentDocumentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the document storage functionality.
     *
     * @return void
     */
    public function testStore()
    {
        // Simulated document for testing
        $file = UploadedFile::fake()->create('testdocument.pdf', 100);

        $response = $this->postJson('/api/students/1/documents', [
            'title' => 'Sample Document',
            'file' => $file,
        ]);

        // Successful response (status 200)
        $response->assertStatus(200);

        // Checking if the document is stored in the database
        $this->assertDatabaseHas('student_documents', [
            'title' => 'Sample Document',
        ]);

        // Check if the file is stored
        $this->assertFileExists($file->getPathname());

        // Using student with id 1 for testing
        $this->assertDatabaseHas('student_documents', [
            'student_id' => 1,
        ]);
    }
}
