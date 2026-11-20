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
                // melhorada pra não ficar broxante
                $niveisBordas = [
                    'A1' => 'border-[#6CC5B8]',
                    'A2' => 'border-[#A3C96B]',
                    'B1' => 'border-[#E3B95A]',
                    'B2' => 'border-[#DE8F52]',
                    'C1' => 'border-[#CC6B6B]',
                    'C2' => 'border-[#9879B8]',
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
              @php
                $niveisBordas = [
                    'A1' => 'border-[#6CC5B8]',
                    'A2' => 'border-[#A3C96B]',
                    'B1' => 'border-[#E3B95A]',
                    'B2' => 'border-[#DE8F52]',
                    'C1' => 'border-[#CC6B6B]',
                    'C2' => 'border-[#9879B8]',
                ];
              @endphp

              @foreach($listeningLessons as $lesson)
                @php
                  $nivelBorda = $niveisBordas[$lesson->nivel ?? 'A1'] ?? 'border-[#3598CA]';
                @endphp
                <a href="{{ route('site.escuta', $lesson->numero) }}"
                   class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 {{ $nivelBorda }} shadow-lg shrink-0 hover:scale-105 transition-transform p-1">
                  <span class="text-[9px] uppercase tracking-wider font-semibold opacity-75 leading-none">Lição</span>
                  <span class="text-lg font-black leading-tight my-0.5">{{ $lesson->numero }}</span>
                  <span class="text-xs font-bold text-gray-600 leading-none">{{ $lesson->nivel ?? 'A1' }}</span>
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
          <h3 class="font-extrabold text-lg mb-4">Progresso em 7 Dias</h3>
          <div class="bg-[#3598CA] p-6 rounded-3xl">
            <canvas id="xpChart" height="140"></canvas>
          </div>

          <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
          <script>
            new Chart(document.getElementById('xpChart'), {
              type: 'line',
              data: {
                labels: @json($grafico['labels']),
                datasets: [{
                  data: @json($grafico['data']),
                  borderColor: '#ffffff',
                  backgroundColor: 'rgba(255,255,255,0.2)',
                  pointBackgroundColor: '#ffffff',
                  fill: true,
                  tension: 0.3,
                }]
              },
              options: {
                plugins: { legend: { display: false } },
                scales: {
                  x: { ticks: { color: '#fff', font: { weight: 'bold' } }, grid: { display: false } },
                  y: { ticks: { color: '#fff', font: { weight: 'bold' }, precision: 0 }, beginAtZero: true, grid: { color: 'rgba(255,255,255,0.15)' } }
                }
              }
            });
          </script>
        </div>

        <div class="bg-[#3598CA] p-6 rounded-3xl shadow-xl">
          <h3 class="font-extrabold text-center text-lg mb-5">Seu ranking de Amigos</h3>
          @if($ranking->count() <= 1)
            <p class="text-center font-bold py-4">Você ainda não adicionou amigos.</p>
          @else
            <ul class="space-y-2 font-bold">
              @foreach($ranking as $i => $pessoa)
                @php $euMesmo = $pessoa->id === $user->id; @endphp
                <li class="flex items-center rounded-xl px-3 py-1 {{ $euMesmo ? 'bg-[#2F8BB9]' : '' }}">
                  <span class="flex-1 truncate">
                    {{ $i + 1 }}. {{ \Illuminate\Support\Str::before($pessoa->name, ' ') }}
                    @if($euMesmo) <span class="text-xs font-extrabold">(você)</span> @endif
                  </span>
                  <span class="w-24 text-right pl-4 border-l border-white/40">{{ $pessoa->xp ?? 0 }}XP</span>
                </li>
              @endforeach
            </ul>
          @endif
          <a href="{{ route('amigos.index') }}" class="block text-center font-extrabold mt-5 hover:underline">
            {{ $ranking->count() <= 1 ? 'Adicionar amigos' : 'Ver todos' }}
          </a>
        </div>
      </div>
    </div>
  </div>
</x-layout>
