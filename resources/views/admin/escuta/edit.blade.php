<x-layout>
  <div class="relative z-10 max-w-5xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="flex justify-between items-center pb-4">
      <h1 class="text-2xl font-black tracking-wide text-white">Editar Lição de Escuta – Aula {{ $lesson->numero }}</h1>
      <a href="{{ route('admin.escuta.index') }}" class="bg-[#03111d] hover:bg-[#082a45] text-white font-extrabold px-5 py-2.5 rounded-2xl border border-white/10 shadow-xl transition-all text-sm">
        Voltar
      </a>
    </header>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="w-full bg-red-600 text-white font-bold px-6 py-3 rounded-2xl shadow-lg">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl border border-white/5 relative">

      <form action="{{ route('admin.escuta.update', $lesson) }}" method="POST" enctype="multipart/form-data" class="space-y-6 w-full">
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
              <div class="bg-[#03111d] p-4 rounded-2xl space-y-3">
                <span class="text-xs font-bold text-cyan-400">Questão {{ $question->ordem }}</span>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <div>
                    <label class="block text-xs text-gray-400 mb-1">Alterar Áudio (opcional)</label>
                    <input type="file" name="questions[{{ $question->id }}][audio]" accept="audio/mpeg,audio/wav,audio/ogg" class="w-full bg-[#051d31] text-white text-xs p-2 rounded-xl file:mr-2 file:py-1 file:px-2 file:rounded-lg file:border-0 file:text-xs file:bg-cyan-400 file:text-[#03111d]">
                    @if($question->audio)
                      <audio controls class="mt-2 h-8 w-full">
                        <source src="{{ asset($question->audio) }}" type="audio/mpeg">
                      </audio>
                    @endif
                  </div>

                  <div>
                    <label class="block text-xs text-gray-400 mb-1">Pergunta / Enunciado</label>
                    <input type="text" name="questions[{{ $question->id }}][pergunta]" value="{{ $question->pergunta }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  @foreach([1, 2, 3, 4] as $n)
                    <div>
                      <label class="block text-xs text-gray-400 mb-1">Opção {{ $n }}</label>
                      <input type="text" name="questions[{{ $question->id }}][resposta_{{ $n }}]" value="{{ $question->{'resposta_'.$n} }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                    </div>
                  @endforeach
                </div>

                <div>
                  <label class="block text-xs text-gray-400 mb-1">Gabarito</label>
                  <select name="questions[{{ $question->id }}][resposta_correta]" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                    @foreach([1, 2, 3, 4] as $n)
                      <option value="{{ $n }}" {{ $question->resposta_correta == $n ? 'selected' : '' }}>Opção {{ $n }}</option>
                    @endforeach
                  </select>
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
