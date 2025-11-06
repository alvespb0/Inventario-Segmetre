<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemSetorRequest extends FormRequest
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
            'item_id' => [
                'required',
                'exists:item,id',
                Rule::unique('item_setor')->where(function ($query) {
                    return $query->where('setor_id', $this->setor_id);
                }),
            ],
            'qtd_estoque' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'setor_id.required' => 'O campo setor é obrigatório.',
            'setor_id.exists' => 'O setor selecionado é inválido ou não existe.',

            'item_id.required' => 'O campo item é obrigatório.',
            'item_id.exists' => 'O item selecionado é inválido ou não existe.',
            'item_id.unique' => 'Este item já está vinculado a este setor.',

            'qtd_estoque.integer' => 'A quantidade em estoque deve ser um número inteiro.',
        ];
    }
}
