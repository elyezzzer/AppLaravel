<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAcessorioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('acessorio');
        $id = $id instanceof \App\Models\Acessorio ? $id->id : $id;

        return [
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('acessorios', 'codigo')
                    ->ignore($id)
                    ->where('user_id', auth()->id())
                    ->whereNull('deleted_at')
            ],
            'descricao' => 'required|string|max:255',
            'cor' => 'required|string',
            'preco' => 'required|numeric|min:0.00',
            'estoque_minimo' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'codigo.unique' => 'Este código já está cadastrado.',
            'preco.min' => 'O preço não pode ser negativo.',
            'estoque_minimo.min' => 'O estoque mínimo não pode ser negativo.',
            'codigo.required' => 'O código é obrigatório.',
            'descricao.required' => 'A descrição é obrigatória.',
            'cor.required' => 'A cor é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'estoque_minimo.required' => 'O estoque mínimo é obrigatório.'
        ];
    }
}