<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlacementQuestion;

class PlacementController extends Controller
{
    private const NIVEIS = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
    private const ACERTOS_MINIMOS = 2;

    public function submitTest(Request $request)
    {
        $request->validate([
            'answers'   => ['required', 'array'],
            'answers.*' => ['nullable', 'string', 'max:500'],
        ]);

        $respostas = $request->input('answers');
        $questoesPorNivel = PlacementQuestion::all()->groupBy('nivel');

        $nivelAlcancado = 'A1';

        foreach (self::NIVEIS as $nivel) {
            $questoes = $questoesPorNivel->get($nivel, collect());

            if ($questoes->isEmpty()) {
                break;
            }

            $acertos = $questoes->filter(function ($q) use ($respostas) {
                return $this->normalizar($respostas[$q->id] ?? '')
                    === $this->normalizar($q->resposta_correta);
            })->count();

            if ($acertos < self::ACERTOS_MINIMOS) {
                break;
            }

            $nivelAlcancado = $nivel;
        }

        $user = auth()->user();
        $user->nivel = $nivelAlcancado;
        $user->save();

        return redirect()->route('site.taskboard')
            ->with('success', "Teste concluído, seu nível definido foi: {$nivelAlcancado}");
    }

    private function normalizar(string $texto): string
    {
        $texto = mb_strtolower(trim($texto));
        $texto = preg_replace('/\s+/u', ' ', $texto);
        return rtrim($texto, ".!? ");
    }

    public function show()
    {
        // Busca todas as questões ordenadas para o quiz interativo
        $questoes = PlacementQuestion::orderBy('nivel')->orderBy('ordem')->get();

        return view('placement.index', compact('questoes'));
    }
}
