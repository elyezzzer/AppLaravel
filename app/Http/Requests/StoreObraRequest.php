<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObraRequest extends FormRequest
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
    public function rules(): array{
    return [
        'nome' => 'required|string|max:255',
        'cidade' => 'nullable|string|max:255',
        'bairro' => 'nullable|string|max:255',
        'rua' => 'nullable|string|max:255',
        'numero' => 'nullable|string|max:50',
        'telefone' => 'nullable|string|max:20',
        'data_inicio' => 'nullable|date'
    ];
}
}
