<x-layout>
  <div class="w-full max-w-4xl mx-auto my-auto z-10">

    @session('success')
    <div class="mb-6 w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg border border-white/20">
      {{ session('success') }}
    </div>
    @endsession

    <div class="w-full bg-[#051d31] p-8 md:p-10 rounded-[2.5rem] shadow-2xl border border-white/5 relative">
      <header class="mb-8 border-b border-white/10 pb-4 flex justify-between items-center">
        <h1 class="text-2xl font-black tracking-wide">Meu Perfil</h1>
        <div class="bg-[#03111d] px-4 py-1.5 rounded-full font-bold text-cyan-400 border border-white/5">
          XP: <span class="text-white">{{ $user->xp ?? 0 }} pts</span>
        </div>
      </header>

      <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
          <div class="md:col-span-7 space-y-5">
            <h2 class="font-extrabold uppercase tracking-wider text-gray-400">Conta & Dados</h2>
            <div class="space-y-1">
              <label for="name" class="block font-bold text-gray-200">Nome:</label>
              <div class="relative flex items-center">
                <input
                  type="text"
                  name="name"
                  id="name"
                  value="{{ $user->name }}"
                  class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner pr-10"
                />
                <i class='bx bx-pencil absolute right-4 text-gray-400 opacity-60 pointer-events-none text-xl'></i>
              </div>
            </div>

            <div class="space-y-1">
              <label for="email" class="block font-bold text-gray-200">E-mail:</label>
              <div class="relative flex items-center">
                <input
                  type="email"
                  name="email"
                  id="email"
                  value="{{ $user->email }}"
                  class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner pr-10"
                />
                <i class='bx bx-pencil absolute right-4 text-gray-400 opacity-60 pointer-events-none text-xl'></i>
              </div>
            </div>

            <div class="space-y-1">
              <label for="data_nasc" class="block font-bold text-gray-200">Data de Nascimento:</label>
              <input
                type="date"
                name="data_nasc"
                id="data_nasc"
                value="{{ $user->data_nasc }}"
                class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner"
              />
            </div>

            <div class="space-y-1">
              <label for="bio" class="block font-bold text-gray-200">Bio:</label>
              <textarea
                name="bio"
                id="bio"
                rows="2"
                class="w-full bg-[#03111d]/90 text-white font-semibold px-5 py-3 rounded-2xl border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner resize-none"
              >{{ $user->bio ?? '' }}</textarea>
            </div>
          </div>

          <div class="md:col-span-5 space-y-6">
            <div class="bg-[#03111d]/50 p-5 rounded-3xl border border-white/5 text-center flex flex-col items-center space-y-3">
              <span class="font-bold text-gray-300">Foto de Perfil</span>
              @if($user->foto_perfil)
                <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto de perfil" class="w-24 h-24 rounded-full border-4 border-cyan-400 object-cover shadow-lg">
              @else
                <div class="w-24 h-24 rounded-full bg-[#082A45] border-2 border-dashed border-white/20 flex items-center justify-center text-gray-400">
                  Sem Foto
                </div>
              @endif

              <label class="cursor-pointer bg-[#082a45] hover:bg-[#3598CA] text-white font-extrabold px-4 py-2 rounded-xl border border-white/10 transition-colors mt-2">
                Alterar Foto
                <input type="file" name="foto_perfil" class="hidden">
              </label>
            </div>

            <div class="space-y-3 pt-2">
              <h3 class="font-extrabold uppercase tracking-wider text-gray-400">Notificações</h3>
              <div class="space-y-2 font-bold text-gray-200">
                <label class="flex items-center justify-between cursor-pointer">
                  <span>Todas</span>
                  <input type="checkbox" checked class="accent-cyan-400 rounded w-4 h-4">
                </label>
                <label class="flex items-center justify-between cursor-pointer">
                  <span>Desafios Diários</span>
                  <input type="checkbox" checked class="accent-cyan-400 rounded w-4 h-4">
                </label>
                <label class="flex items-center justify-between cursor-pointer">
                  <span>Lições Diárias</span>
                  <input type="checkbox" checked class="accent-cyan-400 rounded w-4 h-4">
                </label>
                <label class="flex items-center justify-between cursor-pointer">
                  <span>Ranking</span>
                  <input type="checkbox" checked class="accent-cyan-400 rounded w-4 h-4">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="mt-8 pt-4 border-t border-white/10 flex justify-end">
          <button
            type="submit"
            class="w-full md:w-auto bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-10 py-3 rounded-2xl shadow-xl transition-transform hover:scale-105 active:scale-95 cursor-pointer"
          >
            Salvar Alterações
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layout>
