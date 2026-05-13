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
            'tipo' => ['required'],
            'data_inicio' => ['nullable','required_unless:tipo,estoque','date'],
            'data_fim' => ['nullable','required_unless:tipo,estoque','date','after_or_equal:data_inicio'],
            'codigo' => ['nullable','string'],
            'obra_id' => ['nullable','required_if:tipo,obra','exists:obras,id'],
        ];
    }

    public function messages(){
        return [
            'tipo.required' =>'O tipo de relatório é obrigatório.',
            'data_inicio.required_unless' =>'A data inicial é obrigatória.',
            'data_fim.required_unless' =>'A data final é obrigatória.',
            'data_fim.after_or_equal' =>'A data final não pode ser menor que a data inicial.',
            'obra_id.required_if' =>'Selecione uma obra.',
            'obra_id.exists' =>'A obra selecionada não existe.',
        ];
    }

}
