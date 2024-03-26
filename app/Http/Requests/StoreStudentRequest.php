<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'file|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'string|required|max:255',
            'email' => 'string|required|email|max:255|unique:students',
            'date_birth' => 'nullable|date_format:Y-m-d',
            'contact' => 'string|required|max:20',
            'cpf' => 'string|nullable|unique:students|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
            'cep' => 'nullable|string|max:20',
            'street' => 'required|string',
            'state' => 'required|string|max:2',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'number' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O campo nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo email deve ter no máximo 255 caracteres.',
            'email.unique' => 'O email informado já está em uso.',
            'date_birth.date_format' => 'O campo data de nascimento deve estar no formato Ano-Mês-Dia.',
            'contact.required' => 'O campo contato é obrigatório.',
            'contact.max' => 'O campo contato deve ter no máximo 20 caracteres.',
            'cpf.regex' => 'O campo CPF deve estar no formato válido.',
            'cep.max' => 'O campo CEP deve ter no máximo 20 caracteres.',
        ];
    }
}
