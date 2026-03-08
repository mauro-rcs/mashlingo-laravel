<x-layout>
  <main class="py-10">
    <div class="flex justify-center">
      <h1 class="font-bold text-3xl bg-teal-400 px-8 py-3 shadow-md border-2">
        < Login />
      </h1>
    </div>

    <div class="flex justify-center">
      {{--se der erro do email:--}}
      @error('email')
      <p class="text-red-500 text-xl mt-1">
        {{ $message }}
      </p>
      @enderror
    </div>

    <section class="mt-5">
      <form action="/login"
            method="POST"
            class="flex flex-col items-center gap-3 w-fit border-2 mx-auto px-3 py-2 bg-white">
        @csrf

        <p>
          <label for="email" class="font-bold">Email</label><br>
          <input type="email"
                 name="email"
                 placeholder="seuemail@gmail.com"
                 required
                 class="bg-white p-2 border-2 w-80 font-bold">
        </p>

        <p>
          <label for="password" class="font-bold">Senha</label><br>
          <input type="password"
                 name="password"
                 required
                 placeholder="******"
                 class="bg-white p-2 border-2 w-80">
        </p>

        <p>
          <input type="submit"
                 value="Enviar"
                 class="bg-teal-400 font-bold px-3 py-2 shadow-2xl border-2">
        </p>

      </form>
    </section>

  </main>
</x-layout>
