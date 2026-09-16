<?php

namespace App\Http\Controllers;

use App\Models\ListeningLesson;
use App\Models\ListeningQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListeningLessonController extends Controller
{
    public function index()
    {
        $lessons = ListeningLesson::with('questions')->orderBy('numero')->get();
        return view('admin.escuta.index', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|integer|unique:listening_lessons,numero',
            'titulo' => 'required|string|max:255',
            'instrucao' => 'required|string',
            'xp' => 'required|integer|min:0',
            'questions' => 'required|array|min:3|max:3',
            'questions.*.pergunta' => 'required|string',
            'questions.*.resposta_1' => 'required|string',
            'questions.*.resposta_2' => 'required|string',
            'questions.*.resposta_3' => 'required|string',
            'questions.*.resposta_4' => 'required|string',
            'questions.*.resposta_correta' => 'required|integer|between:1,4',
        ]);

        $lesson = ListeningLesson::create([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
        ]);

        foreach ($request->questions as $index => $qData) {
            $audioPath = null;
            if (isset($qData['audio']) && $qData['audio']->isValid()) {
                $extension = $qData['audio']->getClientOriginalExtension();
                $filename = "aula-{$lesson->numero}-q" . ($index + 1) . '.' . $extension;
                $qData['audio']->move(public_path('listening'), $filename);
                $audioPath = 'listening/' . $filename;
            }

            // Criando direto pelo relacionamento para garantir a FK
            $lesson->questions()->create([
                'ordem' => $index + 1,
                'audio' => $audioPath ?? '',
                'pergunta' => $qData['pergunta'],
                'resposta_1' => $qData['resposta_1'],
                'resposta_2' => $qData['resposta_2'],
                'resposta_3' => $qData['resposta_3'],
                'resposta_4' => $qData['resposta_4'],
                'resposta_correta' => $qData['resposta_correta'],
            ]);
        }

        return redirect()->route('admin.escuta.index')->with('success', 'Lição de escuta criada com sucesso!');
    }

    public function update(Request $request, ListeningLesson $lesson)
    {
        $request->validate([
            'numero' => 'required|integer|unique:listening_lessons,numero,' . $lesson->id,
            'titulo' => 'required|string|max:255',
            'instrucao' => 'required|string',
            'xp' => 'required|integer|min:0',
            'questions' => 'sometimes|array',
            'questions.*.audio' => 'nullable|file|mimes:mp3,wav,ogg|max:5120',
            'questions.*.pergunta' => 'required|string',
            'questions.*.resposta_1' => 'required|string',
            'questions.*.resposta_2' => 'required|string',
            'questions.*.resposta_3' => 'required|string',
            'questions.*.resposta_4' => 'required|string',
            'questions.*.resposta_correta' => 'required|integer|between:1,4',
        ]);

        $lesson->update([
            'numero' => $request->numero,
            'titulo' => $request->titulo,
            'instrucao' => $request->instrucao,
            'xp' => $request->xp,
        ]);

        if ($request->has('questions')) {
            foreach ($request->questions as $questionId => $qData) {
                $question = ListeningQuestion::findOrFail($questionId);

                $updateData = [
                    'pergunta' => $qData['pergunta'],
                    'resposta_1' => $qData['resposta_1'],
                    'resposta_2' => $qData['resposta_2'],
                    'resposta_3' => $qData['resposta_3'],
                    'resposta_4' => $qData['resposta_4'],
                    'resposta_correta' => $qData['resposta_correta'],
                ];

                if (isset($qData['audio'])) {
                    if ($question->audio && file_exists(public_path($question->audio))) {
                        unlink(public_path($question->audio));
                    }

                    $filename = "aula-{$lesson->numero}-q{$question->ordem}." . $qData['audio']->getClientOriginalExtension();
                    $qData['audio']->move(public_path('listening'), $filename);
                    $updateData['audio'] = 'listening/' . $filename;
                }

                $question->update($updateData);
            }
        }

        return redirect()->route('admin.escuta.index')->with('success', 'Lição de escuta atualizada!');
    }

    public function destroy(ListeningLesson $lesson)
    {
        foreach ($lesson->questions as $question) {
            if ($question->audio && file_exists(public_path($question->audio))) {
                unlink(public_path($question->audio));
            }
        }

        $lesson->delete();
        return redirect()->route('admin.escuta.index')->with('success', 'Lição excluída com sucesso!');
    }

    public function showLesson($lesson = 1)
    {
        $lesson = ListeningLesson::with('questions')
            ->where('numero', $lesson)
            ->firstOrFail();

        return view('escuta', compact('lesson'));
    }
}
