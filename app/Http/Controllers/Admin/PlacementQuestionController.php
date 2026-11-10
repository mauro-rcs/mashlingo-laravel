<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlacementQuestion;
use Illuminate\Http\Request;

class PlacementQuestionController extends Controller
{
    public function index(Request $request)
    {
        $nivel = $request->get('nivel', 'A1');
        $questoes = PlacementQuestion::where('nivel', $nivel)->orderBy('ordem')->get();

        return view('admin.placement.index', compact('questoes', 'nivel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nivel' => ['required', 'string'],
            'ordem' => ['required', 'integer'],
            'tipo' => ['required', 'in:escrita,escuta'],
            'frase_portugues' => ['nullable', 'string'],
            'audio' => ['nullable', 'file', 'mimes:mp3,wav,ogg', 'max:2048'],
            'resposta_correta' => ['required', 'string'],
        ]);

        $data = $request->except('audio');

        // Se enviou um áudio, faz o upload para a pasta public/audio ou storage
        if ($request->hasFile('audio')) {
            $file = $request->file('audio');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('audio/placement'), $filename);
            $data['audio'] = 'audio/placement/' . $filename;
        }

        PlacementQuestion::create($data);

        return back()->with('success', 'Questão do nivelamento cadastrada com sucesso');
    }

    public function destroy(PlacementQuestion $question)
    {
        $question->delete();
        return back()->with('success', 'Questão removida com sucesso');
    }
}
