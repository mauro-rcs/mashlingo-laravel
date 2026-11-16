<x-layout>
  <div class="max-w-3xl mx-auto w-full space-y-6 my-8 px-4">

    <header class="bg-[#051d31] p-8 rounded-[2.5rem] shadow-2xl text-center space-y-3">
      <span class="text-xs font-black text-cyan-400 uppercase tracking-widest">Avaliação Concluída!</span>
      <h1 class="text-3xl font-black text-white">Seu nível de proficiência é:</h1>
      <div class="inline-block bg-cyan-500 text-white text-3xl font-black px-6 py-2 rounded-2xl shadow-lg uppercase tracking-wider">
        {{ $nivelAlcancado }}
      </div>
      <p class="text-xs text-gray-300 font-semibold">O seu nível foi atualizado com sucesso no seu perfil.</p>
    </header>

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-6">
      <h2 class="text-xl font-black text-white border-b border-white/10 pb-4">Correção Detalhada por Questão</h2>

      <div class="space-y-4">
        @foreach($questoes as $q)
          @php
            $respostaAluno = $respostas[$q->id] ?? '';
            $avaliacao = $avaliacoes->get($q->id);
            $correta = $avaliacao['correta'] ?? false;
            $explicacao = $avaliacao['explicacao'] ?? '';
          @endphp

          <div class="bg-[#03111d] p-5 rounded-2xl border border-white/5 space-y-2">
            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-cyan-400 uppercase">Nível {{ $q->nivel }} — Questão {{ $q->ordem }}</span>
              <span class="text-xs font-extrabold px-3 py-1 rounded-full {{ $correta ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                {{ $correta ? 'Correto' : 'Incorreto' }}
              </span>
            </div>

            <p class="text-white text-sm font-semibold">PT: {{ $q->frase_portugues }}</p>
            <p class="text-gray-300 text-xs"><strong>Sua resposta:</strong> {{ $respostaAluno ?: '(Vazia)' }}</p>
            <p class="text-cyan-300 text-xs"><strong>Gabarito:</strong> {{ $q->resposta_correta }}</p>

            @if(!empty($explicacao))
              <p class="text-gray-400 text-xs italic bg-black/20 p-2.5 rounded-xl border border-white/5">
                <strong>Feedback da IA:</strong> {{ $explicacao }}
              </p>
            @endif
          </div>
        @endforeach
      </div>

      <div class="pt-4 flex justify-end">
        <a href="{{ route('site.taskboard') }}" class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-black px-8 py-3.5 rounded-2xl shadow-xl transition-all flex items-center gap-2 cursor-pointer">
          <span>Ir para o Início</span>
          <i class='bx bx-right-arrow-alt text-xl'></i>
        </a>
      </div>
    </section>

  </div>
</x-layout>
