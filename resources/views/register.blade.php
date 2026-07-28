<x-layout>
    <div class="w-full max-w-md mx-auto flex flex-col items-center z-10 space-y-6 my-auto">

      <h1 class="text-3xl md:text-4xl font-black text-white tracking-wide text-center">
        Cadastrar Conta
      </h1>

      <div class="w-full bg-[#051d31] p-8 md:p-10 rounded-[2.5rem] shadow-2xl border border-white/5 relative">

        <form action="{{ route('auth.register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf
          <div class="space-y-1">
            <label for="name" class="block font-bold text-gray-300">
              Nome
            </label>
            <input
              type="text"
              name="name"
              id="name"
              value="{{ old('name') }}"
              placeholder="Usuário"
              class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-2.5 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('name') border-red-500 @enderror"
            />
            @error('name')
            <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Campo Data de Nascimento -->
          <div class="space-y-1">
            <label for="data_nasc" class="block font-bold text-gray-300">
              Data de Nascimento
            </label>
            <input
              type="date"
              name="data_nasc"
              id="data_nasc"
              value="{{ old('data_nasc') }}"
              class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-2.5 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('data_nasc') border-red-500 @enderror"
            />
            @error('data_nasc')
            <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Campo Email -->
          <div class="space-y-1">
            <label for="email" class="block font-bold text-gray-300">
              Email
            </label>
            <input
              type="email"
              name="email"
              id="email"
              value="{{ old('email') }}"
              placeholder="usuario@ex.com"
              class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-2.5 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('email') border-red-500 @enderror"
            />
            @error('email')
            <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Campo Senha -->
          <div class="space-y-1">
            <label for="password" class="block font-bold text-gray-300">
              Senha
            </label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="********"
              class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-2.5 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors @error('password') border-red-500 @enderror"
            />
            @error('password')
            <p class="text-red-400 font-semibold text-center mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Campo Confirmar Senha -->
          <div class="space-y-1">
            <label for="password_confirmation" class="block font-bold text-gray-300">
              Confirmar Senha
            </label>
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              placeholder="********"
              class="w-full bg-[#03111d] text-white placeholder-gray-400 font-bold text-center px-5 py-2.5 rounded-full border border-white/5 focus:outline-none focus:border-cyan-400 shadow-inner transition-colors"
            />
          </div>

          <!-- Botão Cadastrar -->
          <div class="pt-3">
            <button
              type="submit"
              class="w-full bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold py-3 px-6 rounded-full shadow-lg transition-transform hover:scale-105 active:scale-95 cursor-pointer"
            >
              Cadastrar
            </button>
          </div>

          <!-- Link para Login -->
          <div class="text-center pt-2">
            <span class="text-gray-300">Já tem uma conta? </span>
            <a href="{{ route('auth.login') }}" class="font-extrabold text-white underline hover:text-cyan-400 transition-colors">
              Entrar
            </a>
          </div>

        </form>

      </div>

    </div>

    <!-- Detalhe decorativo geometrico do fundo (SVGs de montanha) -->
    <div class="absolute bottom-0 left-0 right-0 -z-0 pointer-events-none opacity-40 flex items-end">
      <svg class="w-full h-40" viewBox="0 0 1000 200" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
        <polygon points="0,200 150,80 300,200" fill="#a0c8e6"/>
        <polygon points="200,200 450,20 700,200" fill="#03111d"/>
        <polygon points="600,200 800,90 1000,200" fill="#2083b9"/>
      </svg>
    </div>

  </main>
</x-layout>
