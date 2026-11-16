<?php

namespace App\Http\Controllers;

use App\Models\WritingLesson;
use Illuminate\Http\Request;

class WritingLessonController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->get('categoria', 'entretenimento');

        $lessons = WritingLesson::where('categoria', $categoria)->orderBy('numero')->get();

        return view('admin.escrita.index', compact('lessons', 'categoria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => ['required', 'integer', 'unique:writing_lessons,numero'],
            'titulo' => ['required', 'string', 'max:255'],
            'instrucao' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0'],
            'categoria' => ['required', 'string'],
            'nivel' => ['required', 'string', 'in:A1,A2,B1,B2,C1,C2'],

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.frase_portugues' => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'string'],
        ]);

        $lesson = WritingLesson::create([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
            'categoria' => $request->categoria,
            'nivel' => $request->nivel,
        ]);

        foreach ($request->questions as $ordem => $question) {
            $lesson->questions()->create([
                'ordem' => $ordem + 1,
                'frase_portugues' => $question['frase_portugues'],
                'resposta_correta' => $question['resposta_correta'],
            ]);
        }

        return redirect()
            ->route('admin.escrita.index')
            ->with('success', 'Lição criada com sucesso');
    }

    public function update(Request $request, WritingLesson $lesson)
    {
        $request->validate([
            'numero' => [
                'required',
                'integer',
                'unique:writing_lessons,numero,' . $lesson->id,
            ],
            'titulo' => ['required', 'string', 'max:255'],
            'instrucao' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0'],
            'categoria' => ['required', 'string'],                         // <-- Adicionado na validação
            'nivel' => ['required', 'string', 'in:A1,A2,B1,B2,C1,C2'],     // <-- Adicionado na validação

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.frase_portugues' => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'string'],
        ]);

        $lesson->update([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
            'categoria' => $request->categoria,
            'nivel' => $request->nivel,
        ]);

        $lesson->questions()->delete();

        foreach ($request->questions as $ordem => $question) {
            $lesson->questions()->create([
                'ordem' => $ordem + 1,
                'frase_portugues' => $question['frase_portugues'],
                'resposta_correta' => $question['resposta_correta'],
            ]);
        }

        return redirect()
            ->route('admin.escrita.index')
            ->with('success', 'Lição atualizada com sucesso');
    }

    public function destroy(WritingLesson $lesson)
    {
        $lesson->questions()->delete();
        $lesson->delete();

        return redirect()
            ->route('admin.escrita.index')
            ->with('success', 'Lição excluída com sucesso');
    }
}
