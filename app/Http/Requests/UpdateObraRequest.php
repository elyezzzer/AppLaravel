<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateObraRequest extends FormRequest
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
    protected function prepareForValidation(){
        if ($this->nome) {
            $this->merge([
                'nome' => mb_strtoupper($this->nome, 'UTF-8')
            ]);
        }
    }

    public function rules(): array{
        return [
            'nome' => [
                'required',
                'string',
                'max:100',
                Rule::unique('obras', 'nome')->ignore($this->route('obra')->id),
            ],

            'cidade' => ['nullable', 'string', 'max:255'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'rua' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:50'],
            'telefone' => ['nullable', 'string', 'max:20'],
            'data_inicio' => ['nullable', 'date'],
        ];
    }

    public function messages(){
        return [
            'nome.required' => 'O nome da obra é obrigatório.',
            'nome.unique' => 'Já existe uma obra com nome igual ou muito parecido.',
        ];
    }

}
