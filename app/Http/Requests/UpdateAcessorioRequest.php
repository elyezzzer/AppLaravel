<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAcessorioRequest extends FormRequest
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
    public function rules()
    {
        return [
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('acessorios', 'codigo')
                    ->ignore($this->acessorio->id) 
                    ->whereNull('deleted_at')
            ],
            'descricao' => 'required|string|max:255',
            'cor' => 'required|string',
            'preco' => 'required|numeric|min:0.01',
            'estoque_minimo' => 'required|integer|min:0'
        ];
    }

    public function messages(){
        return [
            'codigo.unique' => 'Este código já está cadastrado.',
            'preco.min' => 'O preço não pode ser negativo.',
            'estoque_minimo.min' => 'O estoque mínimo não pode ser negativo.',
            'codigo.required' => 'O código é obrigatório.',
        ];
    }
}
