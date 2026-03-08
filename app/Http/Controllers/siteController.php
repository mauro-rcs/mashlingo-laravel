<?php

namespace App\Http\Controllers;

## use Illuminate\Http\Request;

class siteController extends Controller
{
    public function index(){
        $name = 'Mauro';
        $habits = ['ler', 'estudar'];

        return view('home', compact('name', 'habits'));
    }

    public function dashboard()
    {
        return view ('dashboard');
    }
}
