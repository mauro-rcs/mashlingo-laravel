<x-layout>
  <div class="max-w-4xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide text-white">
        Gerenciar Teste de Nivelamento
      </h1>
      <p class="text-gray-300 font-semibold max-w-xl mx-auto text-sm">
        Questões de tradução e escuta (3 por nível de A1 para C2).
      </p>
    </header>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="bg-red-500/20 border border-red-500/30 text-red-300 px-6 py-4 rounded-2xl text-sm font-semibold space-y-1">
        <p class="font-bold">Por favor, verifique os campos abaixo:</p>
        <ul class="list-disc list-inside text-xs">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="GET" action="{{ route('admin.placement.index') }}" class="space-y-1">
      <label for="nivel" class="block font-bold text-gray-200">Filtrar por Nível:</label>
      <select name="nivel" id="nivel" onchange="this.form.submit()" class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner">
        @foreach(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $n)
          <option value="{{ $n }}" {{ $nivel == $n ? 'selected' : '' }}>Nível {{ $n }}</option>
        @endforeach
      </select>
    </form>

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-6" x-data="{ tipo: '{{ old('tipo', 'escrita') }}' }">
      <h2 class="text-xl font-black text-cyan-400">Adicionar Questão para o Nível {{ $nivel }}</h2>

      <form action="{{ route('admin.placement.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <input type="hidden" name="nivel" value="{{ $nivel }}">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase mb-1">Tipo de Questão</label>
            <select name="tipo" x-model="tipo" class="w-full bg-[#03111d] text-white font-semibold p-3 rounded-xl border border-white/5 focus:outline-none focus:border-cyan-400">
              <option value="escrita">Tradução Escrita</option>
              <option value="escuta">Escuta (Áudio)</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase mb-1">Ordem (1, 2 ou 3)</label>
            <input type="number" name="ordem" min="1" max="3" value="{{ old('ordem') }}" required class="w-full bg-[#03111d] text-white p-3 rounded-xl border border-white/5 focus:outline-none focus:border-cyan-400">
          </div>
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase mb-1">Áudio (Opcional)</label>
            <input type="file" name="audio" accept="audio/*" class="w-full bg-[#03111d] text-white text-xs p-2.5 rounded-xl border border-white/5 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#3598CA] file:text-white">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase mb-1">Frase em Português / Enunciado</label>
            <input type="text" name="frase_portugues" value="{{ old('frase_portugues') }}" required class="w-full bg-[#03111d] text-white p-3 rounded-xl border border-white/5 focus:outline-none focus:border-cyan-400" placeholder="Ex: Eu gosto de estudar inglês.">
          </div>
          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase mb-1">Resposta Correta (Inglês)</label>
            <input type="text" name="resposta_correta" value="{{ old('resposta_correta') }}" required class="w-full bg-[#03111d] text-white p-3 rounded-xl border border-white/5 focus:outline-none focus:border-cyan-400" placeholder="Ex: I like studying English.">
          </div>
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-6 py-3 rounded-2xl shadow-lg transition-all cursor-pointer">
            Salvar Questão
          </button>
        </div>
      </form>
    </section>

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-4">
      <h2 class="text-xl font-black text-white">Questões Cadastradas - Nível {{ $nivel }}</h2>

      <div class="space-y-3">
        @forelse($questoes as $q)
          <div class="bg-[#03111d] p-4 rounded-2xl flex items-center justify-between">
            <div class="space-y-1">
              <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-cyan-400">Questão {{ $q->ordem }}</span>
                <span class="text-[10px] bg-white/10 text-gray-300 px-2 py-0.5 rounded-full uppercase font-extrabold">{{ $q->tipo ?? 'escrita' }}</span>
              </div>
              <p class="text-white text-sm font-semibold">PT: {{ $q->frase_portugues }}</p>
              <p class="text-gray-400 text-xs">EN: {{ $q->resposta_correta }}</p>

              @if(!empty($q->audio))
                <div class="pt-1">
                  <audio controls src="{{ asset($q->audio) }}" class="h-8 max-w-xs rounded-lg"></audio>
                </div>
              @endif
            </div>

            <form action="{{ route('admin.placement.destroy', $q) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta questão?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-400 hover:text-red-300 font-bold text-sm px-3 py-1 cursor-pointer">Excluir</button>
            </form>
          </div>
        @empty
          <p class="text-gray-400 text-center py-4">Nenhuma questão cadastrada para este nível ainda.</p>
        @endforelse
      </div>
    </section>
  </div>
</x-layout>
