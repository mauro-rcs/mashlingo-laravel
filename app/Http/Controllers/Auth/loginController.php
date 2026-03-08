<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    //receber os dados
    public function authenticate(Request $request)
    {
        $credentials = $request -> validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6']
        ]);

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
