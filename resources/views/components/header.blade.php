<header class="bg-[#051d31] border-b border-white/10 shadow-2xl px-6 py-3.5 flex items-center justify-between font-bold text-sm text-white relative z-50">
  <div class="flex items-center gap-3">
    <a href="{{ route('site.index') }}" class="transition-transform hover:scale-105 active:scale-95">
      <img src="{{ asset('images/logo.png') }}"
           alt="logo"
           class="w-36 rounded-2xl shadow-lg border border-white/10 object-cover">
    </a>
  </div>

  <div class="flex items-center gap-2 md:gap-3">

    @auth
      <a href="{{ route('site.taskboard') }}"
         class="flex items-center gap-2 bg-[#3598CA] hover:bg-[#2F8BB9] text-white rounded-2xl px-4 py-2 shadow-md transition-all duration-200 hover:scale-105 active:scale-95">
        <i class='bx bx-book-open text-lg'></i>
        <span>Aulas</span>
      </a>

      @if(auth()->user()->is_admin)
        <a href="{{ route('site.admin') }}"
           class="flex items-center gap-2 bg-[#082A45] hover:bg-[#0070ba] text-cyan-300 rounded-2xl px-4 py-2 border border-cyan-400/30 shadow-md transition-all duration-200 hover:scale-105 active:scale-95">
          <i class='bx bx-shield-quarter text-lg'></i>
          <span>Admin</span>
        </a>
      @endif

      <form action="{{ route('auth.logout') }}" method="post" class="inline">
        @csrf
        <button type="submit"
                class="flex items-center gap-2 bg-[#03111d] hover:bg-red-600/80 text-gray-300 hover:text-white rounded-2xl px-4 py-2 border border-white/10 shadow-md transition-all duration-200 hover:scale-105 active:scale-95 cursor-pointer">
          <i class="bx bx-door-open-alt"></i>
          <span>Sair</span>
        </button>
      </form>

      <a href="{{ route('site.perfil') }}" class="ml-1 transition-transform hover:scale-105 active:scale-95">
        @if(!auth()->user()->foto_perfil)
          <img src="{{ asset('images/user.jpg') }}"
               alt="Foto de Perfil"
               class="w-10 h-10 rounded-full border-2 border-cyan-400 object-cover shadow-lg">
        @else
          <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}"
               alt="Foto de Perfil"
               class="w-10 h-10 rounded-full border-2 border-cyan-400 object-cover shadow-lg">
        @endif
      </a>
    @endauth

    @guest
      <a href="{{ route('auth.login') }}"
         class="flex items-center gap-2 bg-[#3598CA] hover:bg-[#2F8BB9] text-white rounded-2xl px-5 py-2 shadow-md transition-all duration-200 hover:scale-105 active:scale-95">
        <i class='bx bx-log-in text-lg'></i>
        <span>Login</span>
      </a>
    @endguest
  </div>
</header>
