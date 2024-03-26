<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAvaliationRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'student_id' => 'required|exists:students,id',
            'age' => 'required|integer|min:0',
            'date' => 'required|date_format:Y-m-d H:i:s',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'observations_to_student' => 'nullable|string',
            'observations_to_nutritionist' => 'nullable|string',
            'image' => 'required',
            'measures' => 'required|array',
            'measures.torax' => 'required|numeric',
            'measures.braco_direito' => 'required|numeric',
            'measures.braco_esquerdo' => 'required|numeric',
            'measures.cintura' => 'required|numeric',
            'measures.antebraco_esquerdo' => 'required|numeric',
            'measures.antebraco_direito' => 'required|numeric',
            'measures.abdome' => 'required|numeric',
            'measures.coxa_direita' => 'required|numeric',
            'measures.coxa_esquerda' => 'required|numeric',
            'measures.quadril' => 'required|numeric',
            'measures.panturrilha_direita' => 'required|numeric',
            'measures.panturilha_esquerda' => 'required|numeric',
            'measures.punho' => 'required|numeric',
            'measures.b_femoral_direito' => 'required|numeric',
            'measures.b_femoral_esquerdo' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
        'student_id.required' => 'O ID do estudante é obrigatório.',
        'age.required' => 'A idade é obrigatória.',
        'date.required' => 'A data é obrigatória.',
        'weight.required' => 'O peso é obrigatório.',
        'height.required' => 'A altura é obrigatória.',
        'image' => 'O ID do arquivo é obrigatório.',
        'measures.required' => 'As medidas são obrigatórias.',
        'measures.torax.required' => 'A medida do tórax é obrigatória.',
        'measures.braco_direito.required' => 'A medida do braço direito é obrigatória.',
        'measures.braco_esquerdo.required' => 'A medida do braço esquerdo é obrigatória.',
        'measures.cintura.required' => 'A medida da cintura é obrigatória.',
        'measures.antebraco_esquerdo.required' => 'A medida do antebraço esquerdo é obrigatória.',
        'measures.antebraco_direito.required' => 'A medida do antebraço direito é obrigatória.',
        'measures.abdome.required' => 'A medida do abdome é obrigatória.',
        'measures.coxa_direita.required' => 'A medida da coxa direita é obrigatória.',
        'measures.coxa_esquerda.required' => 'A medida da coxa esquerda é obrigatória.',
        'measures.quadril.required' => 'A medida do quadril é obrigatória.',
        'measures.panturrilha_direita.required' => 'A medida da panturrilha direita é obrigatória.',
        'measures.panturilha_esquerda.required' => 'A medida da panturrilha esquerda é obrigatória.',
        'measures.punho.required' => 'A medida do punho é obrigatória.',
        'measures.b_femoral_direito.required' => 'A medida da coxa femoral direita é obrigatória.',
        'measures.b_femoral_esquerdo.required' => 'A medida da coxa femoral esquerda é obrigatória.',
        ];
    }
}
