<?php

namespace App\Http\Controllers;

use App\Models\StudentDocument;
use Illuminate\Http\Request;
use App\Http\Services\File\CreateFileService;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class StudentDocumentController extends Controller
{

    public function store(Request $request, CreateFileService $createFileService, $id)
    {
        try {
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
                'file_id' => 'required|exists:files,id',
            ]);

            $slug = $request->filled('title') ? Str::slug($request->input("title")) : null;

            $file = $createFileService->handle(
                "student_document",
                $request->file("document"),
                $slug
            );

            $document = StudentDocument::create([
                'title' => $data['title'],
                'file_id' => $data['file_id'],
                'student_id' => $id,
            ]);

            return response()->json(['message' => 'Document created successfully', 'document' => $document], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
