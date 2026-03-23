<x-layout>
  <main class="py-10">
    <div class="flex justify-center">
      <h1 class="font-bold text-3xl bg-[#61B6D8] px-8 py-3 shadow-md border-2">
        Login
      </h1>
    </div>

    <section class="mt-4">
      <form action="{{route('auth.login')}}"
            method="POST"
            class="bg-white max-w-[600px] mx-auto p-10 border-2 mt-4 items-center">
        @csrf
        <h1 class="text-3xl font-bold">
          Realize Login
        </h1>
        <p>
          Insira seus dados para acessar
        </p>

        <p>
          <label for="email" class="font-bold">Email</label><br>
          <input type="email"
                 name="email"
                 placeholder="exemplo@email.com"
                 class="bg-white p-2 border-2 w-full font-bold @error('email') border-red-500 @enderror">
        </p>

        @error('email')
        <p class="text-red-600">
          {{ $message }}
        </p>
        @enderror

        <p>
          <label for="password" class="font-bold">Senha</label><br>
          <input type="password"
                 name="password"
                 placeholder="******"
                 class="bg-white p-2 border-2 w-full font-bold @error('password') border-red-500 @enderror">
        </p>

        @error('password')
        <p class="text-red-600">
          {{ $message }}
        </p>
        @enderror

        <p>
          <button
            type="submit"
            class="bg-[#61B6D8] mt-4 font-bold w-full px-3 py-2 shadow-2xl border-2 hover:bg-[#4a9bc2] transition"
          >
            Enviar
          </button>
        </p>

        <p class="text-center mt-3">
          Ainda não tem uma conta?
          <a href="{{route('site.register')}}"
             class="underline hover:opacity-50 transition">
            Registre-se
          </a>
        </p>
      </form>
    </section>
  </main>
</x-layout>
