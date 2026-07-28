<x-layout>
  <div class="w-full max-w-6xl mx-auto space-y-6 z-10 my-auto">

    <header class="w-full pt-4 pb-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide">Taskboard – Inglês</h1>
    </header>

    <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

      <div class="lg:col-span-7 space-y-6">

        <div>
          <h2 class="font-bold mb-2">Escrita</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3">

            <a href="{{ route('site.escrita') }}"
               class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg shrink-0 hover:scale-105 transition-transform">
              <span>Cap. 1</span>
              <span class="font-normal leading-tight">Atual:</span>
              <span>Aula 3</span>
            </a>

            <!-- Ícone de Cadeado Boxicons -->
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

        <div>
          <h2 class="font-bold mb-2">Audição</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3">

            <button class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg shrink-0 hover:scale-105 transition-transform">
              <span>Cap. 1</span>
              <span class="font-normal leading-tight">Atual:</span>
              <span>Aula 1</span>
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

        <div>
          <h2 class="font-bold mb-2">Pronúncia</h2>
          <div class="bg-[#051d31] p-4 rounded-3xl shadow-xl border border-white/5 flex items-center justify-between gap-3">

            <button class="w-20 h-20 bg-white text-[#082A45] rounded-2xl flex flex-col items-center justify-center font-extrabold border-4 border-cyan-400 shadow-lg shrink-0 hover:scale-105 transition-transform">
              <span>Cap. 1</span>
              <span class="font-normal leading-tight">Atual:</span>
              <span>Aula 2</span>
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
