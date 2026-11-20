<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $friends = $user->friends()->get();

        // ranking: amigos + você, do maior para o menor XP
        $ranking = $friends->concat([$user])->sortByDesc('xp')->values();

        return view('amigos', compact('user', 'friends', 'ranking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();
        $nome = mb_strtolower(trim($request->name));

        $encontrados = User::whereRaw('LOWER(name) = ?', [$nome])->get();

        if ($encontrados->isEmpty()) {
            return back()->withErrors(['name' => 'Nenhum usuário encontrado com esse nome.']);
        }

        if ($encontrados->count() > 1) {
            return back()->withErrors(['name' => 'Existe mais de um usuário com esse nome. Digite o nome completo.']);
        }

        $amigo = $encontrados->first();

        if ($amigo->id === $user->id) {
            return back()->withErrors(['name' => 'Você não pode adicionar a si mesmo.']);
        }

        if ($user->friends()->where('users.id', $amigo->id)->exists()) {
            return back()->withErrors(['name' => 'Essa pessoa já está na sua lista.']);
        }

        $user->friends()->attach($amigo->id);

        return back()->with('success', "{$amigo->name} foi adicionado(a)!");
    }

    public function destroy(User $friend)
    {
        auth()->user()->friends()->detach($friend->id);

        return back()->with('success', 'Amigo removido.');
    }
}
