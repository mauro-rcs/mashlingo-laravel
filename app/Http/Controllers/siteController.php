<?php

namespace App\Http\Controllers;

## use Illuminate\Http\Request;

use Illuminate\View\View;

class siteController extends Controller
{
    public function index(){
        $name = 'Mauro';
        $habits = ['ler', 'estudar'];

        return view('home', compact('name', 'habits'));
    }

    public function dashboard(): View
    {
        $user = auth()->user();

        return view('dashboard', compact('user'));
    }

    public function admin()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        $users = \App\Models\User::all();

        return view('admin', compact('users'));
    }
}
