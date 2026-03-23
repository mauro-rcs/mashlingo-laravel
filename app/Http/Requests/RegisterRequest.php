<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255|string',
            'email' => 'required|email|unique:users',
            'data_nasc' => 'required|date|before:today', // adicionado
            'password' => 'required|min:6|max:60|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo de nome é obrigatório.',
            'name.max' => 'O campo tem mais de 255 caracteres.',
            'name.string' => 'O nome deve ser um texto válido.',

            'email.required' => 'O campo de e-mail é obrigatorio.',
            'email.email' => 'O campo de email deve ser um endereço de e-mail válido.',
            'email.unique' => 'O e-mail já está em uso.',

            'data_nasc.required' => 'A data de nascimento é obrigatória.',
            'data_nasc.date' => 'Digite uma data válida.',
            'data_nasc.before' => 'A data de nascimento deve ser anterior a hoje.',

            'password.required' => 'O campo de senha é obrigatorio.',
            'password.min' => 'A senha deve ter ao menos 6 caracteres.',
            'password.max' => 'A senha deve ter no máximo 60 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
        ];
    }
}
