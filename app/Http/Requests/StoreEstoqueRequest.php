<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstoqueRequest extends FormRequest
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
    public function rules(): array
    {
        $acessorio = \App\Models\Acessorio::find($this->acessorio_id);
        
        return [
            'acessorio_id' => ['required', 'exists:acessorios,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'cor'=> [$acessorio && $acessorio->cor === 'todas' ? 'required' : 'nullable','string'],
        ];
    }

    public function messages(){
        return [
            'acessorio_id.required' => 'O código é obrigatório.',
            'acessorio_id.exists' => 'O código selecionado é inválido.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser superior a 0.',
            'cor.required' => 'A cor é obrigatória para este acessório.',
        ];
    }
}
