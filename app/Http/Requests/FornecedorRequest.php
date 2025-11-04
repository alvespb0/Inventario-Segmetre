<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'nome' => 'required|string|min:4',
            'cnpj' => [
                'required',
                'digits:14', // exatamente 14 dígitos (sem pontos ou traços)
                function ($attribute, $value, $fail) {
                    if (!self::validaCNPJ($value)) {
                        $fail('O CNPJ informado é inválido.');
                    }
                },
                'unique:fornecedores,cnpj,'.$id.',id',
            ],
            'cliente_segmetre' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 4 caracteres.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.digits' => 'O CNPJ deve conter exatamente 14 dígitos (sem pontos ou traços).',
            'cnpj.unique' => 'Este CNPJ já está cadastrado'
        ];
    }

    /**
     * Validação de CNPJ (sem pontos/traços).
     */
    private static function validaCNPJ(string $cnpj): bool
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);
        if (strlen($cnpj) !== 14) {
            return false;
        }
        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        // Cálculo dos dígitos verificadores
        for ($t = 12; $t < 14; $t++) {
            $d = 0;
            $c = 0;
            for ($m = $t - 7, $i = 0; $i < $t; $i++) {
                $d += $cnpj[$i] * $m;
                $m = ($m == 2) ? 9 : $m - 1;
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cnpj[$t] != $d) {
                return false;
            }
        }

        return true;
    }

}
