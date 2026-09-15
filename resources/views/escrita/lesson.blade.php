<x-layout>
  <div class="max-w-4xl mx-auto w-full space-y-6 z-10 my-auto">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide">
        {{ $lesson->titulo }}
      </h1>
      <p class="text-gray-300 font-semibold max-w-xl mx-auto">
        {{ $lesson->instrucao }}
      </p>
    </header>

    @if(session('error'))
      <div class="bg-rose-500/20 text-rose-200 p-4 rounded-2xl text-center font-bold">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{route('writing.complete', $lesson->id)}}" method="POST" class="space-y-6">
      @csrf

      @php
        $feedback = session('feedback');
        $oldAnswers = session('old_answers', []);
      @endphp

      @foreach($lesson->questions as $question)
        @php
          $qFeedback = $feedback[$question->id] ?? null;
          $userAnswer = $oldAnswers[$question->id] ?? '';
        @endphp

        <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-4 relative transition-all">

          <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <span class="bg-[#03111d] px-4 py-1 rounded-full font-bold text-cyan-400 text-sm">
              Questão {{ $question->ordem }}
            </span>

            @if($qFeedback)
              <span class="px-3 py-1 rounded-full font-extrabold text-xs uppercase tracking-wider flex items-center gap-1 {{ $qFeedback['correta'] ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }}">
                @if($qFeedback['correta'])
                  <i class='bx bx-check-circle text-base'></i> Correta
                @else
                  <i class='bx bx-x-circle text-base'></i> Incorreta
                @endif
              </span>
            @endif
          </div>

          <p class="text-lg md:text-xl font-bold text-white pt-1">
            {{ $question->frase_portugues }}
          </p>

          <div class="relative">
            <textarea
              name="answers[{{ $question->id }}]"
              rows="3"
              placeholder="Digite sua tradução aqui..."
              class="w-full bg-[#03111d]/90 text-white font-semibold p-4 rounded-2xl focus:outline-none focus:border-cyan-400 shadow-inner resize-none transition-colors placeholder:text-gray-500"
            >{{ old("answers.{$question->id}", $userAnswer) }}</textarea>
          </div>

          @if($qFeedback)
            <div class="mt-4 p-4 rounded-2xl {{ $qFeedback['correta'] ? 'bg-emerald-950/40' : 'bg-rose-950/40' }} space-y-2 text-sm">

              @if(!$qFeedback['correta'] && !empty($qFeedback['correcao']))
                <div class="flex items-start gap-2">
                  <span class="font-bold text-gray-400">Sugestão:</span>
                  <span class="font-bold text-emerald-400">{{ $qFeedback['correcao'] }}</span>
                </div>
              @endif

              @if(!empty($qFeedback['explicacao']))
                <div class="flex items-start gap-2 text-gray-300">
                  <span class="font-bold text-gray-400">Professor:</span>
                  <p class="font-medium leading-relaxed">{{ $qFeedback['explicacao'] }}</p>
                </div>
              @endif

            </div>
          @endif

        </div>
      @endforeach

      <div class="flex justify-end pt-2">
        <button
          type="submit"
          class="w-full md:w-auto bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-10 py-3.5 rounded-2xl shadow-xl transition-all hover:scale-105 active:scale-95 cursor-pointer flex items-center justify-center gap-2"
        >
          <span>{{ $feedback ? 'Reavaliar com IA' : 'Enviar Respostas' }}</span>
          <i class='bx bx-send text-xl'></i>
        </button>
      </div>
    </form>
  </div>
</x-layout>
