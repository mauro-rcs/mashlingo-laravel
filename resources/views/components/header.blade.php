<header class="bg-[#1A72A2] p-4 border-bottom border-2 flex items-center justify-between font-bold">
  {{--LOGO--}}
  <div>
    MashLingo
  </div>

  <div>
    <a href="https://github.com/mauro-rcs/mashlingo-laravel" class="bg-teal-400 px-3 py-2 ml-2 shadow-2xl border-2">
      GitHub
    </a>

    {{--Logout--}}
    @auth
      <form action="{{route('auth.logout')}}" method="post" class="inline">
        @csrf
        <button type="submit"
                class="bg-teal-400 px-3 py-2 ml-2 shadow-2xl border-2">
          Sair</button>
      </form>
    @endauth

    {{--Login--}}
    @guest
      <a href="{{ route('auth.login') }}"
        class="bg-teal-400 px-3 py-2 ml-2 shadow-2xl border-2">
        Login
      </a>
    @endguest
  </div>
</header>
