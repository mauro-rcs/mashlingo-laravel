<?php

namespace App\Http\Controllers;

use App\Models\WritingLesson;
use App\Models\WritingProgress;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Facades\Prism;

class siteController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('site.taskboard');
        }

        return view('home');
    }

    public function perfil(): View
    {
        $user = auth()->user();

        return view('perfil', compact('user'));
    }

    public function taskboard()
    {
        $user = auth()->user();

        return view('taskboard', compact('user'));
    }

    public function admin()
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $users = \App\Models\User::all();

        return view('admin', compact('users'));
    }

    public function escrita()
    {
        $lessons = WritingLesson::orderBy('numero')->get();

        return view('escrita', compact('lessons'));
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

        return redirect()
            ->route('site.escrita')
            ->with('success', 'Lição concluída!');
    }

    public function submitWritingLesson(
        Request $request,
        WritingLesson $lesson
    ) {
        $request->validate([
            'answers' => ['required', 'array'],
        ]);

        $prompt = <<<PROMPT
Você é um professor de inglês para brasileiros.

Avalie as respostas do aluno nas questões abaixo.

REGRAS:
- Verifique se a resposta transmite corretamente o significado da frase em português.
- Aceite respostas diferentes do gabarito quando forem gramaticalmente corretas e tiverem o mesmo significado.
- Não considere apenas diferenças de pontuação ou capitalização como erro.
- Se houver erro, explique brevemente em português.
- Se a resposta estiver vazia, considere incorreta.
- Seja objetivo.
- NÃO escreva nada fora do JSON.

Retorne EXATAMENTE neste formato:

{
    "questoes": [
        {
            "id": 1,
            "correta": true,
            "explicacao": "",
            "correcao": ""
        }
    ]
}

QUESTÕES:
PROMPT;

        foreach ($lesson->questions as $question) {
            $answer = $request->input(
                "answers.{$question->id}",
                ''
            );

            $prompt .= <<<TEXT

ID: {$question->id}
Questão: {$question->ordem}
Frase em português: {$question->frase_portugues}
Gabarito: {$question->resposta_correta}
Resposta do aluno: {$answer}
TEXT;
        }

        $response = Prism::text()
            ->using(Provider::Ollama, 'llama3.1')
            ->withSystemPrompt(
                'Você é um corretor de exercícios de inglês. ' .
                'Responda APENAS em JSON puro, sem blocos de código markdown.'
            )
            ->withPrompt($prompt)
            ->withClientOptions([
                'timeout' => 120,
            ])
            ->generate();

        $rawText = trim($response->text);

        $cleanJson = preg_replace(
            '/^```(?:json)?\s*|\s*```$/i',
            '',
            $rawText
        );

        $resultado = json_decode(
            trim($cleanJson),
            true
        );

        if (
            json_last_error() !== JSON_ERROR_NONE ||
            !isset($resultado['questoes'])
        ) {
            return back()->with(
                'error',
                'Falha ao processar a resposta da IA. Tente novamente.'
            );
        }

        $feedback = collect($resultado['questoes'])
            ->keyBy('id')
            ->toArray();

        return back()
            ->with('feedback', $feedback)
            ->with('old_answers', $request->input('answers'));
    }
}
