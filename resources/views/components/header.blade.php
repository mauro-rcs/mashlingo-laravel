<header class="bg-[#0961A5] shadow-xl p-4 flex items-center justify-between font-bold">
  <div class="flex items-center gap-2">
    <a href="{{ route('site.index') }}">
      <img src="{{ asset('images/logo.png') }}"
           alt="logo"
           class="w-36 rounded-xl shadow-xl">
    </a>
  </div>

  <div class="flex items-center">
    <a href="https://github.com/mauro-rcs/mashlingo-laravel"
       target="_blank"
       class="text-white border-black bg-[#082A45] hover:bg-[#07253E] rounded-xl transition px-3 py-2 ml-2 shadow-2xl border-2">
      GitHub
    </a>
    @auth

      @if(auth()->user()->is_admin)
        <a href="{{ route('site.admin') }}"
           class="text-white border-black bg-[#082A45] hover:bg-[#07253E] rounded-xl transition px-3 py-2 ml-2 shadow-2xl border-2">
          Admin
        </a>
      @endif

      <form action="{{ route('auth.logout') }}" method="post" class="inline">
        @csrf
        <button type="submit"
                class="text-white cursor-pointer border-black bg-[#082A45] hover:bg-[#07253E] rounded-xl transition px-3 py-2 ml-2 shadow-2xl border-2">
          Sair
        </button>
      </form>

      <a href="{{ route('site.dashboard') }}" class="ml-2">
        @if(!auth()->user()->foto_perfil)
          <img src="{{ asset('images/user.jpg') }}"
               alt="Foto de Perfil"
               class="w-11 rounded-md border-2 object-cover">
        @else
          <img src="{{ asset('storage/' . auth()->user()->foto_perfil) }}"
               alt="Foto de Perfil"
               class="w-11 rounded-md border-2 object-cover">
        @endif
      </a>
    @endauth

    @guest
      <a href="{{ route('auth.login') }}"
         class="text-white border-black bg-[#082A45] hover:bg-[#07253E] rounded-xl transition px-3 py-2 ml-2 shadow-2xl border-2">
        Login
      </a>
    @endguest
  </div>
</header>
