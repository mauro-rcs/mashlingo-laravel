<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "email" => "required|email",
            "password" => "required|min:6|max:60"
        ];
    }
    public function messages(): array
    {
        return [
            "email.required" => "O campo de e-mail é obrigatorio",
            "email.email" => "O campo de e-mail deve ser um endereço válido",
            "password.required" => "O campo de senha é obrigatorio",
            "password.min" => "A senha deve ter ao menos 6 caracteres",
            "password.max" => "A senha deve ter ao menos 60 caracteres"
        ];
    }
}
