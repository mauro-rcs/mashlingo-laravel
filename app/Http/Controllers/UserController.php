<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    //só para o admin (não muito organizado)
    public function edit(User $user)
    {
        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(!auth()->user()->is_admin && $user->id !== auth()->id()){
            abort(403, 'Você não pode alterar estes dados');
        }

        $user->update($request->all());

        if($request->hasFile('foto_perfil')){
            $path = $request->file('foto_perfil')->store('profiles', 'public');
            $user->foto_perfil = $path;
            $user->save();
        }

        if(!auth()->user()->is_admin){
        return redirect()
            ->route('site.dashboard')
            ->with('success', 'Dados atualizados com sucesso');
        }

        return redirect()
            ->route('site.admin')
            ->with('success', 'Dados atualizados com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(!auth()->user()->is_admin){
            abort(403, 'Permissão negada');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Você não pode se deletar');
        }

        $user->delete();

        return redirect()
            ->route('site.admin')
            ->with('Usuário deletado com sucesso!');
    }
}
