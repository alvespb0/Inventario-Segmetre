<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitacaoItemRequest extends FormRequest
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
            'setor_id' => 'required|exists:setor,id',
            'item_id' => 'required|exists:item,id',
            'qtd' => 'required|integer',
            'data_solicitacao' => 'required|date',
            'observacao' => 'nullable|string',
        ];
    }

    
    public function messages(): array
    {
        return [
            'setor_id.required' => 'O campo setor é obrigatório.',
            'setor_id.exists' => 'O setor selecionado não existe.',

            'item_id.required' => 'O campo item é obrigatório.',
            'item_id.exists' => 'O item selecionado não existe.',

            'qtd.required' => 'A quantidade é obrigatória.',
            'qtd.integer' => 'A quantidade deve ser um número inteiro.',

            'data_solicitacao.required' => 'A data de solicitação é obrigatória.',
            'data_solicitacao.date' => 'A data de solicitação deve ser uma data válida.',

            'observacao.string' => 'A observação deve ser um texto válido.',
        ];
    }

}
