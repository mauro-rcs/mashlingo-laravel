<x-layout>
  <div class="w-full max-w-6xl mx-auto space-y-6 z-10 my-auto">

    <header class="w-full pt-4 pb-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide">Taskboard – Inglês</h1>
    </header>

    <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

      <div class="lg:col-span-7 space-y-6">

        <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl md:text-3xl font-black tracking-wide">Minhas Aulas – Inglês</h1>

          <form method="GET" action="{{ route('site.taskboard') }}" class="flex items-center gap-2">
            <label for="categoria" class="font-bold text-gray-300">Temática:</label>
            <select name="categoria" id="categoria" onchange="this.form.submit()" class="bg-[#051d31] text-cyan-400 font-extrabold px-4 py-2 rounded-xl border border-white/10 focus:outline-none focus:border-cyan-400">
              <option value="entretenimento" {{ request('categoria') == 'entretenimento' ? 'selected' : '' }}>Entretenimento</option>
              <option value="viagens" {{ request('categoria') == 'viagens' ? 'selected' : '' }}>Viagens</option>
              <option value="negocios" {{ request('categoria') == 'negocios' ? 'selected' : '' }}>Negócios</option>
            </select>
          </form>
        </div>

        <div>
          <h2 class="font-bold mb-2">Escrita</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3 overflow-x-auto">

            <div class="flex items-center gap-3">
              @php
                // Mapeamento das bordas do botão baseadas na paleta (do mais claro ao mais escuro)
                $niveisBordas = [
                    'A1' => 'border-[#a9d6e5]',
                    'A2' => 'border-[#61a5c2]',
                    'B1' => 'border-[#3598CA]',
                    'B2' => 'border-[#2c6298]',
                    'C1' => 'border-[#134074]',
                    'C2' => 'border-[#0b2545]',
                ];
              @endphp

              @foreach($writingLessons as $lesson)
                @php
                  $nivelBorda = $niveisBordas[$lesson->nivel ?? 'A1'] ?? 'border-[#3598CA]';
                @endphp
                <a href="{{ route('writing.lesson', $lesson->numero) }}"
                   class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 {{ $nivelBorda }} shadow-lg shrink-0 hover:scale-105 transition-transform p-1">
                  <span class="text-[9px] uppercase tracking-wider font-semibold opacity-75 leading-none">Lição</span>
                  <span class="text-lg font-black leading-tight my-0.5">{{ $lesson->numero }}</span>
                  <span class="text-xs font-bold text-gray-600 leading-none">{{ $lesson->nivel ?? 'A1' }}</span>
                </a>
              @endforeach

              @if($writingLessons->isEmpty())
                <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner shrink-0">
                  <i class='bx bxs-lock-alt text-3xl'></i>
                </div>
              @endif
            </div>

            <a href="{{ route('site.escrita') }}" class="text-white hover:text-cyan-400 transition-colors pr-1 shrink-0">
              <i class='bx bx-chevron-right text-3xl'></i>
            </a>

          </div>
        </div>

        <div>
          <h2 class="font-bold mb-2">Audição</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3 overflow-x-auto">

            <div class="flex items-center gap-3">
              @foreach($listeningLessons as $lesson)
                <a href="{{ route('site.escuta', $lesson->numero) }}"
                   class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg shrink-0 hover:scale-105 transition-transform">
                  <span class="text-xs uppercase tracking-wider font-semibold opacity-75">Lição</span>
                  <span class="text-xl font-black">{{ $lesson->numero }}</span>
                </a>
              @endforeach

              @if($listeningLessons->isEmpty())
                <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner shrink-0">
                  <i class='bx bxs-lock-alt text-3xl'></i>
                </div>
              @endif
            </div>

            <a href="{{ route('site.escuta') }}" class="text-white hover:text-cyan-400 transition-colors pr-1 shrink-0">
              <i class='bx bx-chevron-right text-3xl'></i>
            </a>

          </div>
        </div>

        <div>
          <h2 class="font-bold mb-2">Pronúncia</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3">

            <button class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg shrink-0 hover:scale-105 transition-transform">
              <span>N/A</span>
              <span class="font-normal leading-tight">Atual:</span>
              <span>N/A</span>
            </button>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner shrink-0">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner shrink-0">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner shrink-0">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <button class="text-white hover:text-cyan-400 transition-colors pr-1">
              <i class='bx bx-chevron-right text-3xl'></i>
            </button>
          </div>
        </div>
      </div>

      <div class="lg:col-span-5 space-y-6">
        <div class="bg-[#3598CA] p-6 rounded-3xl shadow-xl text-center">
          <h3 class="font-extrabold text-lg mb-4">Desafio do Dia</h3>
          <div class="space-y-4 text-left font-bold">
            <div>
              <p class="mb-1.5">• Completar 2 lições de escrita</p>
              <div class="flex items-center gap-2">
                <div class="w-full bg-[#051d31]/30 rounded-full h-3">
                  <div class="bg-[#082a45] h-3 rounded-full w-1/2"></div>
                </div>
                <span class="shrink-0">1/2</span>
              </div>
            </div>

            <div>
              <p class="mb-1.5">• Completar 1 lição de audição</p>
              <div class="flex items-center gap-2">
                <div class="w-full bg-white/30 rounded-full h-3"></div>
                <span class="shrink-0">0/1</span>
              </div>
            </div>

            <div>
              <p class="mb-1.5">• Completar 1 lição de pronúncia</p>
              <div class="flex items-center gap-2">
                <div class="w-full bg-white/30 rounded-full h-3"></div>
                <span class="shrink-0">0/1</span>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-[#3598CA] p-6 rounded-3xl shadow-xl">
          <h3 class="font-extrabold text-center text-lg mb-5">Seu ranking de Amigos</h3>
          <ul class="space-y-2 font-bold">
            <li class="flex justify-between border-r border-white/40 pr-4">
              <span>1. Benício</span>
              <span class="pl-4 border-l border-white/40">200XP</span>
            </li>
            <li class="flex justify-between border-r border-white/40 pr-4">
              <span>2. João</span>
              <span class="pl-4 border-l border-white/40">168XP</span>
            </li>
            <li class="flex justify-between border-r border-white/40 pr-4">
              <span>3. Silvana</span>
              <span class="pl-4 border-l border-white/40">140XP</span>
            </li>
            <li class="flex justify-between border-r border-white/40 pr-4">
              <span>4. Laura</span>
              <span class="pl-4 border-l border-white/40">100XP</span>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-layout>
