<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'data_nasc' => $request->input('data_nasc'),
            'password' => $request->input('password'),
            'bio' => null,
            'foto_perfil' => null,
            'xp' => 0,
        ]);

        Auth::login($user);

        return redirect()->route('site.dashboard');
    }
}
