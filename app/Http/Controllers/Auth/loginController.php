<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//regras de validação separada do request

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    //receber os dados
    public function authenticate(LoginRequest $request)
    {
        //dd é dump
        //dd($request->all());
        $credentials = $request->only('email', 'password');

        //validando se as credenciais são v/f
        if(Auth::attempt($credentials)){
            //se deu certo, atualiza a sessão
            $request->session()->regenerate();

            //envia pra home
            return redirect()->intended(route('site.dashboard'));
        }

        return back()->withErrors([
            'email' => "Credenciais Incorretas",
        ]);
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('site.index'));
    }
}
