<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GerarRelatorioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(){
        return [
            'data_inicio' => ['nullable', 'date'],
            'data_fim' => ['nullable', 'date', 'after_or_equal:data_inicio'],
            'tipo' => ['required'],
            'codigo' => ['nullable', 'string'],
        ];
    }

    public function messages(){
        return [
            'data_fim.after_or_equal' => 'A data final não pode ser menor que a data inicial.',
        ];
    }

}
