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
        return [
            'acessorio_id' => ['required', 'exists:acessorios,id'],
            'quantidade' => ['required', 'integer', 'min:1'],
            'cor' => ['required', 'string', 'max:30'],
            'preco' => ['required', 'numeric', 'min:0'],
        ];
    }
}
