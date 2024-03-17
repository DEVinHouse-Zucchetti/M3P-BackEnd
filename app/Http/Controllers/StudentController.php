<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $searchQuery = $request->input('q');

            $studentsQuery = Student::query();

            if ($searchQuery) {
                $studentsQuery->where('name', 'like', "%$searchQuery%")
                              ->orWhere('cpf', 'like', "%$searchQuery%")
                              ->orWhere('email', 'like', "%$searchQuery%");
            }

            $students = $studentsQuery->orderBy('name')->get();

            $formattedStudents = $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'contact' => $student->contact,
                    'cpf' => $student->cpf,
                ];
            });

            return response()->json($formattedStudents, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }
}
