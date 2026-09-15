<?php

namespace App\Http\Controllers;

use App\Models\WritingLesson;
use Illuminate\Http\Request;

class WritingLessonController extends Controller
{
    public function index()
    {
        $lessons = WritingLesson::with('questions')
            ->orderBy('numero')
            ->get();

        return view('admin.escrita.index', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => ['required', 'integer', 'unique:writing_lessons,numero'],
            'titulo' => ['required', 'string', 'max:255'],
            'instrucao' => ['required', 'string'],
            'xp' => ['required', 'integer', 'min:0'],

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.frase_portugues' => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'string'],
        ]);

        $lesson = WritingLesson::create([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
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
            ->with('success', 'Lição criada com sucesso!');
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

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.frase_portugues' => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'string'],
        ]);

        $lesson->update([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
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
