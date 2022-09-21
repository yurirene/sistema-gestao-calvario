<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo' => 'required',
            'inicio' => 'required|size:16',
            'final' => 'required|size:16',
            'cor' => 'required',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'O campo :attribute é obrigatório',
            '*.size' => 'O campo :attribute precisa ter 16 caracteres',

        ];
    }

    public function attributes()
    {
        return [
            "titulo" => 'Título',
            "inicio" => 'Data Inicial',
            "final" => 'Data Final',
            "cor" => 'Cor',
        ];
    }
}
