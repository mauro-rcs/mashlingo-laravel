@php
  $niveisBordas = [
      'A1' => 'border-[#a9d6e5]',
      'A2' => 'border-[#61a5c2]',
      'B1' => 'border-[#3598CA]',
      'B2' => 'border-[#2c6298]',
      'C1' => 'border-[#134074]',
      'C2' => 'border-[#0b2545]',
  ];
@endphp

<x-layout>
  <div class="relative z-10 max-w-5xl mx-auto w-full space-y-8 my-8 px-4 box-border">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide text-white">
        Painel de Lições de Escrita
      </h1>
      <p class="text-gray-300 font-bold max-w-xl mx-auto text-sm">
        Cadastre novas lições e gerencie as questões de tradução existentes.
      </p>
    </header>

    <form method="GET" action="{{ route('admin.escrita.index') }}" class="space-y-1">
      <label for="categoria" class="block font-bold text-gray-200">Temática / Categoria:</label>
      <select name="categoria" id="categoria" onchange="this.form.submit()" class="w-full bg-[#03111d]/90 text-white font-bold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner">
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
        <ul class="list-disc list-inside text-sm font-bold space-y-1 pt-1">
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
            <input type="number" name="numero" required class="w-full bg-[#03111d] text-white font-bold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Título da Lição</label>
            <input type="text" name="titulo" required class="w-full bg-[#03111d] text-white font-bold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>

          <div>
            <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Recompensa (XP)</label>
            <input type="number" name="xp" required class="w-full bg-[#03111d] text-white font-bold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 transition-colors">
          </div>
        </div>

        <div>
          <label class="block text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Instrução da Lição</label>
          <textarea name="instrucao" rows="2" required class="w-full bg-[#03111d] text-white font-bold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 resize-none transition-colors"></textarea>
        </div>

        <div>
          <label class="block text-xs font-bold text-gray-300 uppercase mb-2">Nível da Lição</label>
          <select name="nivel" class="w-full bg-[#03111d] text-white font-bold p-3.5 rounded-2xl focus:ring-2 focus:ring-cyan-400 outline-none">
            @foreach(['A1', 'A2', 'B1', 'B2', 'C1', 'C2'] as $niv)
              <option value="{{ $niv }}" {{ old('nivel') == $niv ? 'selected' : '' }}>
                Nível {{ $niv }}
              </option>
            @endforeach
          </select>
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
                    <input type="text" name="questions[{{ $i }}][frase_portugues]" class="w-full bg-[#051d31] text-white text-sm font-bold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
                  </div>
                  <div>
                    <label class="block text-xs text-gray-400 font-bold mb-1">Resposta Correta (Gabarito)</label>
                    <input type="text" name="questions[{{ $i }}][resposta_correta]" class="w-full bg-[#051d31] text-white text-sm font-bold p-3 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
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

    <section class="space-y-4 w-full">
      <h2 class="text-xl font-black text-white px-2">Lições Cadastradas ({{ ucfirst($categoria ?? 'entretenimento') }})</h2>

      <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex flex-wrap items-center gap-3">
        @forelse($lessons as $lesson)
          @php
            $nivelBorda = $niveisBordas[$lesson->nivel ?? 'A1'] ?? 'border-[#3598CA]';
          @endphp
          <a href="{{ route('admin.escrita.edit', $lesson) }}"
             class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 {{ $nivelBorda }} shadow-lg shrink-0 hover:scale-105 transition-transform p-1">
            <span class="text-[9px] uppercase tracking-wider font-extrabold leading-none">Lição</span>
            <span class="text-lg font-black leading-tight my-0.5">{{ $lesson->numero }}</span>
            <span class="text-xs font-extrabold text-[#082A45] leading-none">{{ $lesson->nivel ?? 'A1' }}</span>
          </a>
        @empty
          <div class="w-full py-4 text-center text-gray-400 font-bold">
            Nenhuma lição cadastrada nesta categoria.
          </div>
        @endforelse
      </div>
    </section>
  </div>
</x-layout>
