<x-layout>
  <div class="text-center font-bold py-5 text-white mt-5 bg-black border-2 border-[#082A45]">
    <p class="text-3xl">
      Bem Vindo ao MashLingo! 👋
    </p>
    <p class="text-xl">
      Seja bem vindo ao nosso sistema de
      aprendizado com base midiática!
    </p>
  </div>

  <div class="flex flex-col justify-center items-center mt-5">
    <img src="{{ asset('images/logo.png') }}" alt="">

    <a href="{{route('auth.login')}}"
    class="bg-[#082A45] text-white font-bold px-6 py-2 border-1 border-black rounded-4xl shadow-2xl text-xl
    hover:bg-[#07253E] transition">
      Vamos Começar →
    </a>

  </div>
</x-layout>
