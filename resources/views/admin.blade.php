<x-layout>
  <div class="max-w-6xl mx-auto w-full my-auto z-10 space-y-6">
    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl relative flex flex-col md:flex-row justify-between items-center gap-4 pb-4">
      <h1 class="text-2xl font-black tracking-wide">
        Painel de Admin
      </h1>
      <div class="flex gap-3">
        <a
          href="{{ route('site.admin') }}"
          class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition-transform hover:scale-105"
        >
          <i class='bx bx-user'></i>
          Usuários
        </a>

        <a
          href="{{ route('admin.escrita.index') }}"
          class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-bold px-5 py-2.5 rounded-xl shadow-md transition-transform hover:scale-105"
        >
          <i class='bx bx-edit'></i>
          Lições de escrita
        </a>

        <a
          href="{{ route('admin.escuta.index') }}"
          class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-bold px-5 py-2.5 rounded-xl shadow-md"
        >
          <i class='bx bx-headphone'></i>
          Lições de escuta
        </a>
      </div>
    </header>

    @session('success')
    <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
      {{ session('success') }}
    </div>
    @endsession
    <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl relative">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
          <tr class="text-gray-400 font-extrabold uppercase border-b ">
            <th class="pb-4 px-4">Foto</th>
            <th class="pb-4 px-4">Nome</th>
            <th class="pb-4 px-4">Email</th>
            <th class="pb-4 px-4">XP</th>
            <th class="pb-4 px-4 text-center">Ações</th>
          </tr>
          </thead>

          <tbody class="divide-y divide-white/5 font-semibold">
          @foreach($users as $user)
            <tr class="hover:bg-[#03111d]/50 transition-colors">

              <td class="py-3.5 px-4">
                @if($user->foto_perfil)
                  <img src="{{ asset('storage/' . $user->foto_perfil) }}"
                       class="w-11 h-11 rounded-full border-2 border-cyan-400 object-cover shadow-md">
                @else
                  <img src="{{ asset('images/user.jpg') }}"
                       class="w-11 h-11 rounded-full border-2 border-white/20 object-cover shadow-md">
                @endif
              </td>

              <td class="py-3.5 px-4 text-white font-bold">
                {{ $user->name }}
              </td>

              <td class="py-3.5 px-4 text-gray-300">
                {{ $user->email }}
              </td>

              <td class="py-3.5 px-4">
                  <span class="inline-block bg-[#03111d] text-cyan-300 px-3 py-1 rounded-full font-bold border border-white/5">
                    {{ $user->xp ?? 0 }} XP
                  </span>
              </td>

              <td class="py-3.5 px-4 text-center space-x-2">

                <a href="{{ route('user.edit', $user) }}"
                   class="inline-flex items-center gap-1.5 bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-bold px-4 py-2 rounded-xl shadow-md transition-transform hover:scale-105 active:scale-95">
                  <i class='bx bx-pencil text-lg'></i>
                  Editar
                </a>

                <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          onclick="return confirm('Tem certeza que deseja excluir este usuário?')"
                          class="inline-flex items-center gap-1.5 bg-[#03111d] hover:bg-[#2F8BB9] font-extrabold px-4 py-2 rounded-xl shadow-md transition-all cursor-pointer">
                    <i class='bx bx-trash text-lg'></i>
                    Excluir
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-layout>
