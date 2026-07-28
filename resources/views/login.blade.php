<x-layout>
  <div class="w-full max-w-md mx-auto flex flex-col items-center z-10 space-y-6 my-auto">

    <h1 class="text-3xl md:text-4xl font-black text-white tracking-wide text-center">
      Fazer Login
    </h1>

    <div class="w-full bg-[#051d31] p-8 md:p-10 rounded-[2.5rem] shadow-2xl border border-white/5 relative">
      <form action="{{ route('auth.login') }}" method="POST" class="space-y-5">
        @csrf
        <div class="space-y-1.5">
          <label for="email" class="block font-bold text-gray-300">
            Usuário (e-mail)
          </label>
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
            placeholder="email@exemplo.com"
            class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-3 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('email') border-red-500 @enderror"
          />
          @error('email')
          <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="space-y-1.5">
          <label for="password" class="block font-bold text-gray-300">
            Senha
          </label>
          <input
            type="password"
            name="password"
            id="password"
            placeholder="********"
            class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-3 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('password') border-red-500 @enderror"
          />
          @error('password')
          <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div class="text-center pt-1 text-gray-300">
          Ainda não tem uma conta?
          <a href="{{ route('site.register') }}" class="font-extrabold text-white underline hover:text-cyan-400 transition-colors">
            Cadastre-se
          </a>
        </div>

        <div class="pt-2">
          <button
            type="submit"
            class="w-full bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold py-3 px-6 rounded-full shadow-lg transition-transform hover:scale-105 active:scale-95 cursor-pointer"
          >
            Realizar Login
          </button>
        </div>
      </form>
    </div>
  </div>
</x-layout>
