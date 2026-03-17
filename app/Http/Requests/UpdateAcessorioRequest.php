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
            'codigo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'cor' => 'required|string',
            'preco' => 'required|numeric',
            'estoque_minimo' => 'required|integer|min:0'
        ];
    }
}
