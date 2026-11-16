<x-layout>
  <div class="relative z-10 max-w-5xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="flex justify-between items-center pb-4">
      <h1 class="text-2xl font-black tracking-wide text-white">Editar Lição de Escrita – Aula {{ $lesson->numero }}</h1>
      <a href="{{ route('admin.escrita.index') }}" class="bg-[#03111d] hover:bg-[#082a45] text-white font-extrabold px-5 py-2.5 rounded-2xl border border-white/10 shadow-xl transition-all text-sm">
        Voltar
      </a>
    </header>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl border border-white/5 relative">

      <form action="{{ route('admin.escrita.update', $lesson) }}" method="POST" class="space-y-6 w-full">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Número</label>
            <input type="number" name="numero" value="{{ old('numero', $lesson->numero) }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Título</label>
            <input type="text" name="titulo" value="{{ old('titulo', $lesson->titulo) }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">XP</label>
            <input type="number" name="xp" value="{{ old('xp', $lesson->xp) }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Categoria</label>
            <select name="categoria" class="w-full bg-[#03111d] text-white p-3.5 rounded-xl outline-none focus:ring-2 focus:ring-cyan-400 font-semibold">
              <option value="entretenimento" {{ old('categoria', $lesson->categoria) == 'entretenimento' ? 'selected' : '' }}>Entretenimento</option>
              <option value="viagens" {{ old('categoria', $lesson->categoria) == 'viagens' ? 'selected' : '' }}>Viagens</option>
              <option value="negocios" {{ old('categoria', $lesson->categoria) == 'negocios' ? 'selected' : '' }}>Negócios</option>
            </select>
          </div>
        </div>

        <div>
          <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Instrução</label>
          <textarea name="instrucao" rows="2" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 resize-none">{{ old('instrucao', $lesson->instrucao) }}</textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-gray-300 uppercase mb-2">Nível da Lição</label>
          <select name="nivel" class="w-full bg-[#03111d] text-white p-3.5 rounded-2xl focus:ring-2 focus:ring-cyan-400 outline-none font-semibold">
            @foreach(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $niv)
              <option value="{{ $niv }}" {{ old('nivel', $lesson->nivel) == $niv ? 'selected' : '' }}>
                Nível {{ $niv }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="space-y-3 pt-2">
          <h4 class="text-sm font-bold text-gray-300">Questões da Aula</h4>

          <div class="space-y-3">
            @foreach($lesson->questions as $question)
              <div class="bg-[#03111d] p-4 rounded-2xl space-y-2">
                <span class="text-xs font-bold text-cyan-400">Questão {{ $question->ordem }}</span>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <input type="text" name="questions[{{ $loop->index }}][frase_portugues]" value="{{ $question->frase_portugues }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">

                  <input type="text" name="questions[{{ $loop->index }}][resposta_correta]" value="{{ $question->resposta_correta }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="flex justify-end pt-2">
          <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg transition-all cursor-pointer text-sm flex items-center gap-2">
            <i class='bx bx-save text-lg'></i> Salvar Alterações
          </button>
        </div>
      </form>

    </div>

  </div>
</x-layout>
