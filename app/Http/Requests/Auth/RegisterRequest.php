<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Informe nome de usuário.',
            'email.required' => 'Informe email.',
            'password.required' => 'Campo obrigatório.',
            'password.min' => 'Senha precisa ter no minimo 8 caracteres.',
            'password.confirmed' => 'Confirme a senha corretamente.'
        ];
    }
}
