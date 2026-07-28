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

    public function perfil(): View
    {
        $user = auth()->user();

        return view('perfil', compact('user'));
    }

    public function admin()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403);
        }

        $users = \App\Models\User::all();

        return view('admin', compact('users'));
    }

    //ESCRITA
    public function taskboard()
    {
        $user = auth()->user();
        $users = \App\Models\User::all();

        return view('taskboard', compact('user'));
    }

    public function escrita()
    {
        return view('escrita');
    }

    public function writingLesson($lesson)
    {
        return view('escrita.licao', compact('lesson'));
    }

    public function completeLesson($lesson)
    {
        WritingProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'lesson' => $lesson,
            ],
            [
                'completed' => true,
                'completed_at' => now(),
            ]
        );

        return redirect()->route('site.escrita')
            ->with('success', 'Lição concluída!');
    }

    public function lesson(string $lesson)
    {
        $lesson->load('questions');

        return view('escrita.licao', compact('licao'));
    }
}
