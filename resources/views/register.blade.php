<x-layout>
  <main class="py-10">
    <div class="flex justify-center">
      <h1 class="font-bold text-3xl bg-[#3598CA] px-8 py-3 shadow-md border-2">
        Cadastro
      </h1>
    </div>

    <section class="mt-4">
      <form action="{{route('auth.register')}}"
            method="POST"
            class="bg-white max-w-[600px] mx-auto p-10 border-2 mt-4 items-center"
            enctype="multipart/form-data">
        @csrf

        <h1 class="text-3xl font-bold">
          Realize seu Cadastro!
        </h1>
        <p>
          Preencha suas informações para realizar seu cadastro.
        </p>

        <!-- Nome -->
        <p>
          <label for="name" class="font-bold">Nome</label><br>
          <input type="text"
                 name="name"
                 value="{{ old('name') }}"
                 placeholder="Seu nome"
                 class="bg-white p-2 border-2 w-full font-bold @error('name') border-red-500 @enderror">
        </p>
        @error('name')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        <!-- Email -->
        <p>
          <label for="email" class="font-bold">Email</label><br>
          <input type="email"
                 name="email"
                 value="{{ old('email') }}"
                 placeholder="exemplo@email.com"
                 class="bg-white p-2 border-2 w-full font-bold @error('email') border-red-500 @enderror">
        </p>
        @error('email')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        <!-- Data de Nascimento -->
        <p>
          <label for="data_nasc" class="font-bold">Data de Nascimento</label><br>
          <input type="date"
                 name="data_nasc"
                 value="{{ old('data_nasc') }}"
                 class="bg-white p-2 border-2 w-full font-bold @error('data_nasc') border-red-500 @enderror">
        </p>
        @error('data_nasc')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        <!-- Senha -->
        <p>
          <label for="password" class="font-bold">Senha</label><br>
          <input type="password"
                 name="password"
                 placeholder="******"
                 class="bg-white p-2 border-2 w-full font-bold @error('password') border-red-500 @enderror">
        </p>
        @error('password')
        <p class="text-red-600">{{ $message }}</p>
        @enderror

        <!-- Confirmar Senha -->
        <p>
          <label for="password_confirmation" class="font-bold">Confirmar Senha</label><br>
          <input type="password"
                 name="password_confirmation"
                 placeholder="******"
                 class="bg-white p-2 border-2 w-full font-bold">
        </p>

        <p>
          <button type="submit"
                  class="bg-[#3598CA] mt-4 font-bold w-full px-3 py-2 shadow-2xl border-2 hover:bg-[#2F8BB9] transition">
            Cadastrar
          </button>
        </p>

        <p class="text-center mt-3">
          Já possui uma conta?
          <a href="{{ route('site.login') }}"
             class="underline hover:opacity-50 transition">
            Realize Login
          </a>
        </p>
      </form>
    </section>
  </main>
</x-layout>
