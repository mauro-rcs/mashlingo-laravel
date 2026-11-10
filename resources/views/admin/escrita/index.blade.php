<x-layout>
  <div class="max-w-5xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide text-white">
        Painel de Lições de Escrita
      </h1>
      <p class="text-gray-300 font-semibold max-w-xl mx-auto text-sm">
        Cadastre novas lições e gerencie as questões de tradução existentes.
      </p>
    </header>

    <form method="GET" action="{{ route('admin.escrita.index') }}" class="space-y-1">
      <label for="categoria" class="block font-bold text-gray-200">Temática / Categoria:</label>
      <select name="categoria" id="categoria" onchange="this.form.submit()" class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner">
        <option value="entretenimento" {{ (isset($categoria) && $categoria == 'entretenimento') ? 'selected' : '' }}>Entretenimento</option>
        <option value="viagens" {{ (isset($categoria) && $categoria == 'viagens') ? 'selected' : '' }}>Viagens</option>
        <option value="negocios" {{ (isset($categoria) && $categoria == 'negocios') ? 'selected' : '' }}>Negócios</option>
      </select>
    </form>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
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
          <i class='bx bx-plus-circle'></i> Criar Nova Lição
        </h2>
      </div>

      <form action="{{ route('admin.escrita.store') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="categoria" value="{{ $categoria ?? 'entretenimento' }}">

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
            <i class='bx bx-list-ol text-cyan-400'></i> Cadastrar Questões Iniciais
          </h3>

          <div class="grid grid-cols-1 gap-4">
            @for($i = 0; $i < 3; $i++)
              <div class="bg-[#03111d] p-4 rounded-2xl space-y-3">
                <span class="inline-block bg-[#051d31] text-cyan-400 text-xs font-black px-3 py-1 rounded-full">
                  Questão {{ $i + 1 }}
                </span>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Frase em Português</label>
                    <input type="text" name="questions[{{ $i }}][frase_portugues]" class="w-full bg-[#051d31] text-white text-sm font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Resposta Correta (Gabarito)</label>
                    <input type="text" name="questions[{{ $i }}][resposta_correta]" class="w-full bg-[#051d31] text-white text-sm font-semibold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                </div>
              </div>
            @endfor
          </div>
        </div>

        <div class="flex justify-end pt-2">
          <button type="submit" class="w-full md:w-auto bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-xl transition-all cursor-pointer flex items-center justify-center gap-2">
            <span>Criar Lição</span>
          </button>
        </div>
      </form>
    </section>

    <section class="space-y-4 w-full bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl">
      <div class="flex justify-between items-center px-2">
        <h2 class="text-xl font-black text-white">Lições Cadastradas ({{ ucfirst($categoria ?? 'entretenimento') }})</h2>
      </div>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pt-2">
        @forelse($lessons as $lesson)
          <a href="{{ route('admin.escrita.edit', $lesson) }}"
             class="bg-white text-[#082A45] p-4 rounded-2xl flex flex-col items-center justify-center text-center border-4 border-cyan-400 shadow-lg hover:scale-105 transition-transform min-h-[110px] group relative">

            <span class="font-black text-base">Aula {{ $lesson->numero }}</span>
            <span class="text-xs font-bold text-gray-600 truncate max-w-full px-1 mt-1">{{ $lesson->titulo }}</span>

            <span class="absolute top-2 right-2 bg-[#082A45] text-cyan-300 text-[10px] font-extrabold px-2 py-0.5 rounded-full">
              {{ $lesson->xp }}xp
            </span>
          </a>
        @empty
          <div class="col-span-full py-8 text-center text-gray-400 font-medium">
            Nenhuma lição cadastrada nesta categoria.
          </div>
        @endforelse
      </div>
    </section>
  </div>
</x-layout>
