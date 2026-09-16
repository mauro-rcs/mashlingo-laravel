<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-layout>
  <div class="max-w-5xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide text-white">
        Painel de Lições de Escuta
      </h1>
      <p class="text-gray-300 font-semibold max-w-xl mx-auto text-sm">
        Cadastre novas lições e gerencie os áudios e opções de múltipla escolha.
      </p>
    </header>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg"">
        <p class="font-bold pb-1">Atenção! Verifique os campos:</p>
        <ul class="list-disc list-inside text-sm font-semibold space-y-1 pt-1">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-6 w-full">
      <div class="pb-2">
        <h2 class="text-xl font-black text-cyan-400 flex items-center gap-2">
          <i class='bx bx-plus-circle'></i> Criar Nova Lição de Escuta
        </h2>
      </div>

      <form action="{{ route('admin.escuta.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Número da Aula</label>
            <input type="number" name="numero" required class="w-full bg-[#03111d] text-white font-semibold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Título da Lição</label>
            <input type="text" name="titulo" required class="w-full bg-[#03111d] text-white font-semibold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Recompensa (XP)</label>
            <input type="number" name="xp" required class="w-full bg-[#03111d] text-white font-semibold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>
        </div>

        <div>
          <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Instrução da Lição</label>
          <textarea name="instrucao" rows="2" required class="w-full bg-[#03111d] text-white font-semibold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 resize-none transition-colors"></textarea>
        </div>

        <div class="space-y-4 pt-4">
          <h3 class="text-base font-bold text-white flex items-center gap-2">
            <i class='bx bx-headphone text-cyan-400'></i> Cadastrar 3 Questões Iniciais
          </h3>

          <div class="grid grid-cols-1 gap-6">
            @for($i = 0; $i < 3; $i++)
              <div class="bg-[#03111d] p-5 rounded-2xl space-y-4">
                <span class="inline-block bg-[#051d31] text-cyan-400 text-xs font-black px-3 py-1 rounded-full">
                  Questão {{ $i + 1 }}
                </span>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Arquivo de Áudio (.mp3, .wav)</label>
                    <input type="file" name="questions[{{ $i }}][audio]" accept="audio/mpeg,audio/wav,audio/ogg" required class="w-full bg-[#051d31] text-white text-xs p-3 rounded-xl file:mr-4 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-cyan-400 file:text-[#03111d]">
                  </div>

                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Pergunta / Enunciado</label>
                    <input type="text" name="questions[{{ $i }}][pergunta]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Opção 1</label>
                    <input type="text" name="questions[{{ $i }}][resposta_1]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Opção 2</label>
                    <input type="text" name="questions[{{ $i }}][resposta_2]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Opção 3</label>
                    <input type="text" name="questions[{{ $i }}][resposta_3]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Opção 4</label>
                    <input type="text" name="questions[{{ $i }}][resposta_4]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                </div>

                <div>
                  <label class="block text-xs text-gray-400 font-bold mb-1">Opção Correta (Gabarito)</label>
                  <select name="questions[{{ $i }}][resposta_correta]" required class="w-full bg-[#051d31] text-white text-sm font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                    <option value="1">Opção 1</option>
                    <option value="2">Opção 2</option>
                    <option value="3">Opção 3</option>
                    <option value="4">Opção 4</option>
                  </select>
                </div>
              </div>
            @endfor
          </div>
        </div>

        <div class="flex justify-end pt-2">
          <button type="submit" class="w-full md:w-auto bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-xl transition-all cursor-pointer flex items-center justify-center gap-2">
            <span>Criar Lição</span>
            <i class='bx bx-check text-xl'></i>
          </button>
        </div>
      </form>
    </section>

    <section class="space-y-4 w-full">
      <h2 class="text-xl font-black text-white px-2">Lições de Escuta Cadastradas</h2>

      @forelse($lessons as $lesson)
        <div x-data="{ open: false }" class="bg-[#051d31] rounded-[2rem] shadow-2xl transition-all overflow-hidden w-full">

          <div @click="open = !open" class="p-6 cursor-pointer flex flex-col md:flex-row md:items-center justify-between gap-4 hover:bg-[#082842] transition-colors select-none">
            <div class="flex items-center gap-4 min-w-0">
              <span class="bg-[#03111d] px-3.5 py-1.5 rounded-full font-extrabold text-cyan-400 text-xs uppercase tracking-wider shrink-0">
                Aula {{ $lesson->numero }}
              </span>
              <div class="min-w-0">
                <h3 class="text-lg font-black text-white truncate">{{ $lesson->titulo }}</h3>
                <p class="text-xs text-gray-400 font-medium truncate">{{ $lesson->instrucao }}</p>
              </div>
            </div>

            <div class="flex items-center gap-3 self-end md:self-auto shrink-0" @click.stop>
              <span class="text-cyan-500 px-3 py-1 rounded-xl font-black text-xs">
                {{ $lesson->xp }} XP
              </span>

              <form action="{{ route('admin.escuta.destroy', $lesson) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta lição?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-[#03111d] hover:bg-[#082842] p-2 rounded-xl transition-all cursor-pointer text-sm font-bold flex items-center gap-1">
                  <i class='bx bx-trash text-base text-cyan-400'></i>
                </button>
              </form>

              <button type="button" @click="open = !open" class="text-gray-400 hover:text-white transition-transform duration-200" :class="{ 'rotate-180': open }">
                <i class='bx bx-chevron-down text-2xl'></i>
              </button>
            </div>
          </div>

          <div x-show="open" x-collapse x-cloak class="p-6 pt-0 space-y-6 mt-2 w-full">

            <form action="{{ route('admin.escuta.update', $lesson) }}" method="POST" enctype="multipart/form-data" class="space-y-6 pt-2 w-full">
              @csrf
              @method('PUT')

              <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Número</label>
                  <input type="number" name="numero" value="{{ $lesson->numero }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                </div>

                <div>
                  <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Título</label>
                  <input type="text" name="titulo" value="{{ $lesson->titulo }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                </div>

                <div>
                  <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">XP</label>
                  <input type="number" name="xp" value="{{ $lesson->xp }}" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                </div>
              </div>

              <div>
                <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-1">Instrução</label>
                <textarea name="instrucao" rows="2" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 resize-none">{{ $lesson->instrucao }}</textarea>
              </div>

              <div class="space-y-4 pt-2">
                <h4 class="text-sm font-bold text-gray-300">Questões da Aula</h4>

                <div class="space-y-4">
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
                        <div>
                          <label class="block text-xs text-gray-400 mb-1">Opção 1</label>
                          <input type="text" name="questions[{{ $question->id }}][resposta_1]" value="{{ $question->resposta_1 }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                        <div>
                          <label class="block text-xs text-gray-400 mb-1">Opção 2</label>
                          <input type="text" name="questions[{{ $question->id }}][resposta_2]" value="{{ $question->resposta_2 }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                        <div>
                          <label class="block text-xs text-gray-400 mb-1">Opção 3</label>
                          <input type="text" name="questions[{{ $question->id }}][resposta_3]" value="{{ $question->resposta_3 }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                        <div>
                          <label class="block text-xs text-gray-400 mb-1">Opção 4</label>
                          <input type="text" name="questions[{{ $question->id }}][resposta_4]" value="{{ $question->resposta_4 }}" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                        </div>
                      </div>

                      <div>
                        <label class="block text-xs text-gray-400 mb-1">Gabarito</label>
                        <select name="questions[{{ $question->id }}][resposta_correta]" class="w-full bg-[#051d31] text-white text-sm font-semibold p-2.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                          <option value="1" {{ $question->resposta_correta == 1 ? 'selected' : '' }}>Opção 1</option>
                          <option value="2" {{ $question->resposta_correta == 2 ? 'selected' : '' }}>Opção 2</option>
                          <option value="3" {{ $question->resposta_correta == 3 ? 'selected' : '' }}>Opção 3</option>
                          <option value="4" {{ $question->resposta_correta == 4 ? 'selected' : '' }}>Opção 4</option>
                        </select>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="flex justify-end pt-2">
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold px-6 py-2.5 rounded-xl shadow-lg transition-all cursor-pointer text-sm flex items-center gap-2">
                  <i class='bx bx-save text-lg text-cyan-400'></i> Salvar Alterações
                </button>
              </div>
            </form>

          </div>

        </div>
      @empty
        <div class="bg-[#051d31] p-8 rounded-[2.5rem] text-center text-gray-400">
          Nenhuma lição de escuta cadastrada até o momento.
        </div>
      @endforelse
    </section>

  </div>
</x-layout>
