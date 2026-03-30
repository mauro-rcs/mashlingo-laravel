<x-layout>
  <main class="py-10">
    <div class="flex justify-center">
      <h1 class="font-bold text-3xl font-black bg-[#3598CA] px-8 py-3 shadow-md border-2">
        Painel de Admin
      </h1><br>
    </div>

    <div class="flex justify-center">
      @session('success')
        <h1 class="font-bold mt-5 text-xl text-white border-black bg-[#082A45] px-8 py-3 shadow-md border-2">
          {{session('success')}}
        </h1>
      @endsession
    </div>

    <div class="max-w-6xl mx-auto mt-10">
      <div class="bg-white shadow-xl border-2 overflow-x-auto">

        <table class="w-full text-left font-bold">
          <thead class="bg-[#082A45] text-white">
          <tr>
            <th class="px-4 py-3">Foto</th>
            <th class="px-4 py-3">Nome</th>
            <th class="px-4 py-3">Email</th>
            <th class="px-4 py-3">XP</th>
            <th class="px-4 py-3 text-center">Ações</th>
          </tr>
          </thead>

          <tbody>
          @foreach($users as $user)
            <tr class="border-t hover:bg-gray-100 transition">

              <td class="px-4 py-3">
                @if($user->foto_perfil)
                  <img src="{{ asset('storage/' . $user->foto_perfil) }}"
                       class="w-12 h-12 rounded-md border-2 object-cover">
                @else
                  <img src="{{ asset('images/user.jpg' . $user->foto_perfil) }}"
                       class="w-12 h-12 rounded-md border-2 object-cover">
                @endif
              </td>

              <td class="px-4 py-3">
                {{ $user->name }}
              </td>

              <td class="px-4 py-3">
                {{ $user->email }}
              </td>

              <td class="px-4 py-3">
                {{ $user->xp }}
              </td>

              <td class="px-4 py-3 text-center">

                <a href="{{route('user.edit', $user)}}"
                   class="bg-[#3598CA] mt-4 font-bold px-3 py-2 shadow-2xl border-2 hover:bg-[#2F8BB9] transition">
                  Editar</a>

                <form action="{{ route('user.destroy', $user) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')

                  <button type="submit"
                          class="bg-[#082A45] mt-4 text-white font-bold px-3 py-2 shadow-2xl border-2 hover:opacity-50 transition">
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
  </main>
</x-layout>
