<x-layout>
  <div class="max-w-6xl mx-auto w-full space-y-6 z-10 my-auto">

    <header class="text-center pt-4">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide">Minhas Aulas – Escrita</h1>
    </header>

    <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
      <div class="lg:col-span-3">
        <div class="bg-[#3598CA] p-5 rounded-3xl shadow-2xl text-center space-y-4">
          <h3 class="font-black text-lg">Desafio do Dia</h3>

          <div class="space-y-3 text-left font-bold">
            <div>
              <p class="mb-1">• Completar 2 lições de escrita</p>
              <div class="w-full bg-[#051d31]/30 rounded-full h-2">
                <div class="bg-cyan-300 h-2 rounded-full w-1/2"></div>
              </div>
            </div>

            <div>
              <p class="mb-1">• Completar 1 lição de audição</p>
              <div class="w-full bg-white/30 rounded-full h-2"></div>
            </div>

            <div>
              <p class="mb-1">• Completar 1 lição de pronúncia</p>
              <div class="w-full bg-white/30 rounded-full h-2"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-6">
        <div class="bg-[#051d31] p-8 rounded-[2.5rem] shadow-2xl border border-white/5 relative flex flex-col items-center">

          <h2 class="text-2xl font-extrabold text-center mb-8">Capítulo 1 – Pronomes</h2>

          <div class="grid grid-cols-4 gap-4 mb-10 w-full max-w-md place-items-center">

            @for($i = 1; $i <= 1; $i++)
              <a href="{{ route('writing.lesson', $i) }}"
                 class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg hover:scale-105 transition-transform">
                Aula {{ $i }}
              </a>
            @endfor

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

            <div class="w-20 h-20 bg-[#03111d] rounded-2xl flex items-center justify-center text-gray-600 shadow-inner">
              <i class='bx bxs-lock-alt text-3xl'></i>
            </div>

          </div>

          <div class="w-full flex justify-end">
            <a href="#" class="bg-[#0070ba] hover:bg-[#005a96] text-white font-bold py-2 px-6 rounded-xl shadow-md transition-colors underline underline-offset-2">
              Retornar
            </a>
          </div>
        </div>
      </div>

      <div class="lg:col-span-3">
        <div class="bg-[#3598CA] p-5 rounded-3xl shadow-2xl">
          <h3 class="font-black text-center text-lg mb-4">Seu ranking de Amigos</h3>
          <ul class="space-y-2 font-bold">
            <li class="flex justify-between border-r border-white/30 pr-2"><span>1. Benício</span> <span class="pl-2 border-l border-white/30">200XP</span></li>
            <li class="flex justify-between border-r border-white/30 pr-2"><span>2. João</span> <span class="pl-2 border-l border-white/30">168XP</span></li>
            <li class="flex justify-between border-r border-white/30 pr-2"><span>3. Silvana</span> <span class="pl-2 border-l border-white/30">140XP</span></li>
            <li class="flex justify-between border-r border-white/30 pr-2"><span>4. Laura</span> <span class="pl-2 border-l border-white/30">100XP</span></li>
            <li class="flex justify-between border-r border-white/30 pr-2"><span>5. Você</span> <span class="pl-2 border-l border-white/30">50XP</span></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-layout>
