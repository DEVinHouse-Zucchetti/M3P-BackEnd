<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use Illuminate\Http\Request;
use App\Http\Services\File\CreateFileService;
use Symfony\Component\HttpFoundation\Response;

class StudentDocumentController extends Controller
{
    private $createFileService;

    public function __construct(CreateFileService $createFileService)
    {
        $this->createFileService = $createFileService;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
                'file_id' => 'required|exists:files,id',
            ]);

            $studentId = auth()->user()->id;

            $document = StudentDocument::create([
                'title' => $data['title'],
                'file_id' => $data['file_id'],
                'student_id' => $studentId,
            ]);

            return response()->json(['message' => 'Document created successfully', 'document' => $document], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
