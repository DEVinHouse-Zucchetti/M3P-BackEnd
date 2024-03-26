<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AvaliationFirstStep extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'age' => 'required|integer|min:0',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'observations_to_student' => 'nullable|string',
            'observations_to_nutritionist' => 'nullable|string',
        ];
    }
}

