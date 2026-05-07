<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetiradaEstoqueRequest extends FormRequest
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
            'quantidade' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) {
                    $estoque = $this->route('estoque');

                    if ($estoque && is_numeric($value) && $value > $estoque->quantidade) {
                        $fail('Quantidade maior que o estoque.');
                    }
                },
            ],
            'obra_id' => ['required', 'exists:obras,id'],
        ];
    }

    public function messages(){
        return [
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser superior a 0.',
            'obra_id.required' => 'A obra é obrigatória.',
            'obra_id.exists' => 'A obra selecionada é inválida.',
        ];
    }
}
