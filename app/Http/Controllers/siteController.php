<?php

namespace App\Http\Controllers;

## use Illuminate\Http\Request;

use Illuminate\View\View;
use App\Models\WritingLesson;
use App\Models\WritingProgress;
use Prism\Prism\Facades\Prism;
use Prism\Prism\Enums\Provider;
use Illuminate\Http\Request;

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

    public function submitWritingLesson(Request $request, WritingLesson $lesson)
    {
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
            $answer = $request->input("answers.{$question->id}", '');

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
                'Você é um corretor de exercícios de inglês. Responda APENAS em JSON puro, sem blocos de código markdown ```json.'
            )
            ->withPrompt($prompt)
            ->withClientOptions([
                'timeout' => 120,
            ])
            ->generate();

        $rawText = trim($response->text);

        // 1. Remove blocos de código markdown (```json ... ```) se existirem
        $cleanJson = preg_replace('/^```(?:json)?\s*|\s*```$/i', '', $rawText);
        $cleanJson = trim($cleanJson);

        // 2. Decodifica o JSON
        $resultado = json_decode($cleanJson, true);

        // 3. Validação com mensagem legível
        if (json_last_error() !== JSON_ERROR_NONE) {
            dd([
                'erro_json' => json_last_error_msg(),
                'texto_original' => $rawText,
                'texto_limpo' => $cleanJson
            ]);
        }

        dd($resultado);
    }
}
