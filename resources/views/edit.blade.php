<x-layout>
  <main class="py-10">

    <div class="flex justify-center">
      <h1 class="font-bold text-3xl font-black bg-[#3598CA] px-8 py-3 shadow-md border-2">
        Meu Perfil
      </h1>
    </div>

    <form action="{{route('user.update', $user->id)}}"
          method="post"
          enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mt-8 max-w-4xl mx-auto text-black">
        <div class="bg-white p-6 border-2">
          <h2 class="text-2xl font-bold mb-4">
            Meus Dados Pessoais
          </h2>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="name" class="font-bold text-xl">Nome:</label><br>
              <input type="text" name="name" class="px-3 py-2 border-2 w-full mt-2" value="{{$user->name}}">
            </div>

            <div>
              <label for="email" class="font-bold text-xl">Email:</label><br>
              <input type="text" name="email" class="px-3 py-2 border-2 w-full mt-2" value="{{$user->email}}">
            </div>

            <div>
              <label for="data_nasc" class="font-bold text-xl">Data de Nascimento:</label><br>
              <input type="date" name="data_nasc" class="px-3 py-2 border-2 w-full mt-2" value="{{$user->data_nasc}}">
            </div>

            <div>
              <p class="font-bold text-xl">XP:</p>
              <p class="text-xl font-light">{{ $user->xp ?? 0 }} pontos</p>
            </div>

            <div class="col-span-2">
              <label for="bio" class="font-bold text-xl">Bio:</label><br>
              <textarea name="bio"
                        class="px-3 py-2 border-2 w-full mt-2"
                        rows="2">{{$user->bio ?? "Nenhuma Bio Cadastrada"}}
              </textarea>
            </div>

            <div class="col-span-2">
              <p class="font-bold ">Foto de Perfil:</p>
              @if($user->foto_perfil)
                <img src="{{ asset('storage/' . $user->foto_perfil) }}"
                     alt="Foto de perfil"
                     class="w-32 h-32 rounded-full mt-2">
              @else
                <p class="text-xl">Sem foto cadastrada</p>
              @endif
            </div>

            <div class="col-span-2">
              <label class="font-bold">Alterar Foto:</label>
              <input type="file" name="foto_perfil"
                     class="mt-2 border-2 px-3 py-2 w-full bg-white">
            </div>

          </div>
            <div class="">
              <button type="submit"
                      class="bg-[#3598CA] mt-4 w-full text-center text-xl mt-5 font-bold px-3 py-2 shadow-2xl border-2 hover:bg-[#2F8BB9] transition">
                Editar
              </button>
            </div>
        </div>
      </div>
    </form>
  </main>
</x-layout>
