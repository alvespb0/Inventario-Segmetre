<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'login' => 'required|string|max:255',
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'senha' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',  
                'regex:/[\W_]/',   
            ],
            'setor_id' => 'required|exists:setor,id',
            'is_administrator' => 'required|boolean',

        ];
    }
    
    /**
     * Obtenha as mensagens de erro personalizadas para a solicitação.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'login.required' => 'O campo login é obrigatório.',
            'login.string' => 'O campo login deve ser uma string.',
            'login.max' => 'O campo login não pode ter mais de 255 caracteres.',

            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email fornecido não é válido.',
            'email.unique' => 'Este e-mail já está registrado.',

            'senha.required' => 'O campo senha é obrigatório.',
            'senha.string' => 'A senha deve ser uma string.',
            'senha.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'senha.regex' => 'A senha deve conter pelo menos uma letra maiúscula e um caractere especial.',

            'setor_id.required' => 'O campo setor é obrigatório.',
            'setor_id.exists' => 'O setor selecionado não existe.',

            'is_administrator.required' => 'O campo administrador é obrigatório.',
            'is_administrator.boolean' => 'O campo administrador deve ser verdadeiro ou falso.',
        ];
    }

}
