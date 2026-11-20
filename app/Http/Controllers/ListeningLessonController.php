<?php

namespace App\Http\Controllers;

use App\Models\ListeningLesson;
use Illuminate\Http\Request;

class ListeningLessonController extends Controller
{
    public function index(Request $request)
    {
        $categoria = $request->get('categoria', 'entretenimento');

        $lessons = ListeningLesson::where('categoria', $categoria)
            ->orderBy('numero')
            ->get();

        return view('admin.escuta.index', compact('lessons', 'categoria'));
    }

    public function edit(ListeningLesson $lesson)
    {
        $lesson->load('questions');

        return view('admin.escuta.edit', compact('lesson'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero'    => ['required', 'integer', 'unique:listening_lessons,numero'],
            'titulo'    => ['required', 'string', 'max:255'],
            'instrucao' => ['required', 'string'],
            'xp'        => ['required', 'integer', 'min:0'],
            'categoria' => ['required', 'string'],
            'nivel'     => ['required', 'string', 'in:A1,A2,B1,B2,C1,C2'],

            'questions'                    => ['required', 'array', 'min:1'],
            'questions.*.audio'            => ['required', 'file', 'mimes:mp3,wav,ogg'],
            'questions.*.pergunta'         => ['required', 'string'],
            'questions.*.resposta_1'       => ['required', 'string'],
            'questions.*.resposta_2'       => ['required', 'string'],
            'questions.*.resposta_3'       => ['required', 'string'],
            'questions.*.resposta_4'       => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'in:1,2,3,4'],
        ]);

        $lesson = ListeningLesson::create($request->only([
            'numero', 'titulo', 'instrucao', 'xp', 'categoria', 'nivel',
        ]));

        foreach ($request->questions as $i => $q) {
            $path = $request->file("questions.$i.audio")->store('audios', 'public');

            $lesson->questions()->create([
                'ordem'            => $i + 1,
                'audio'            => 'storage/' . $path,
                'pergunta'         => $q['pergunta'],
                'resposta_1'       => $q['resposta_1'],
                'resposta_2'       => $q['resposta_2'],
                'resposta_3'       => $q['resposta_3'],
                'resposta_4'       => $q['resposta_4'],
                'resposta_correta' => $q['resposta_correta'],
            ]);
        }

        return redirect()
            ->route('admin.escuta.index', ['categoria' => $lesson->categoria])
            ->with('success', 'Lição criada com sucesso');
    }

    public function update(Request $request, ListeningLesson $lesson)
    {
        $request->validate([
            'numero'    => ['required', 'integer', 'unique:listening_lessons,numero,' . $lesson->id],
            'titulo'    => ['required', 'string', 'max:255'],
            'instrucao' => ['required', 'string'],
            'xp'        => ['required', 'integer', 'min:0'],
            'categoria' => ['required', 'string'],
            'nivel'     => ['required', 'string', 'in:A1,A2,B1,B2,C1,C2'],

            'questions'                    => ['required', 'array', 'min:1'],
            'questions.*.audio'            => ['nullable', 'file', 'mimes:mp3,wav,ogg'],
            'questions.*.pergunta'         => ['required', 'string'],
            'questions.*.resposta_1'       => ['required', 'string'],
            'questions.*.resposta_2'       => ['required', 'string'],
            'questions.*.resposta_3'       => ['required', 'string'],
            'questions.*.resposta_4'       => ['required', 'string'],
            'questions.*.resposta_correta' => ['required', 'in:1,2,3,4'],
        ]);

        $lesson->update($request->only([
            'numero', 'titulo', 'instrucao', 'xp', 'categoria', 'nivel',
        ]));

        foreach ($request->questions as $id => $q) {
            $question = $lesson->questions()->findOrFail($id);

            $data = [
                'pergunta'         => $q['pergunta'],
                'resposta_1'       => $q['resposta_1'],
                'resposta_2'       => $q['resposta_2'],
                'resposta_3'       => $q['resposta_3'],
                'resposta_4'       => $q['resposta_4'],
                'resposta_correta' => $q['resposta_correta'],
            ];

            if ($request->hasFile("questions.$id.audio")) {
                $path = $request->file("questions.$id.audio")->store('audios', 'public');
                $data['audio'] = 'storage/' . $path;
            }

            $question->update($data);
        }

        return redirect()
            ->route('admin.escuta.index', ['categoria' => $lesson->categoria])
            ->with('success', 'Lição atualizada com sucesso');
    }

    public function showLesson($lesson = 1)
    {
        $lesson = ListeningLesson::with('questions')
            ->where('numero', $lesson)
            ->firstOrFail();

        return view('escuta', compact('lesson'));
    }

    public function destroy(ListeningLesson $lesson)
    {
        $lesson->questions()->delete();
        $lesson->delete();

        return redirect()
            ->route('admin.escuta.index')
            ->with('success', 'Lição excluída com sucesso');
    }

    // mantenha aqui o seu showLesson() atual
}
