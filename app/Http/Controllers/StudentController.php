<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        try {
            $name = $request->input('name');
            $cpf = $request->input('cpf');
            $email = $request->input('email');

            $studentsQuery = Student::query();

            if ($name) {
                $studentsQuery->where('name', 'like', "%$name%");
            }

            if ($cpf) {
                $studentsQuery->orWhere('cpf', 'like', "%$cpf%");
            }

            if ($email) {
                $studentsQuery->orWhere('email', 'like', "%$email%");
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
