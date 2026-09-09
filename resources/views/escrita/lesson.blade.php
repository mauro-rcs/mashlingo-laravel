<x-layout>
  <div class="max-w-4xl mx-auto w-full space-y-6 z-10 my-auto">

    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl border border-white/5 text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide">
        {{ $lesson->titulo }}
      </h1>
      <p class="text-gray-300 font-semibold max-w-xl mx-auto">
        {{ $lesson->instrucao }}
      </p>
    </header>

    <form action="{{route('writing.complete', $lesson->id)}}" method="POST" class="space-y-6">
      @csrf

      @foreach($lesson->questions as $question)
        <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-4 relative">

          <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <span class="bg-[#03111d] px-4 py-1 rounded-full font-bold text-cyan-400 text-sm">
              Questão {{ $question->ordem }}
            </span>
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
            ></textarea>
          </div>

        </div>
      @endforeach

      <div class="flex justify-end pt-2">
        <button
          type="submit"
          class="w-full md:w-auto bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-10 py-3.5 rounded-2xl shadow-xl transition-all hover:scale-105 active:scale-95 cursor-pointer flex items-center justify-center gap-2"
        >
          <span>Enviar Respostas</span>
          <i class='bx bx-send text-xl'></i>
        </button>
      </div>

    </form>

  </div>
</x-layout>
