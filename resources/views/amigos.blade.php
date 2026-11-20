<x-layout>
  <div class="relative z-10 max-w-3xl mx-auto w-full space-y-6 my-8 px-4 box-border">

    <header class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl text-center space-y-2">
      <h1 class="text-2xl md:text-3xl font-black tracking-wide text-white">Amigos</h1>
      <p class="text-gray-300 font-bold text-sm">Adicione colegas pelo nome e compare o XP de vocês.</p>
    </header>

    @if(session('success'))
      <div class="w-full text-center font-bold bg-[#3598CA] text-white px-6 py-3 rounded-2xl shadow-lg">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="w-full text-center font-bold bg-[#3598ca] text-white px-6 py-3 rounded-2xl shadow-lg">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-4">
      <h2 class="text-xl font-black text-cyan-400 flex items-center gap-2">
        <i class='bx bx-user-plus'></i> Adicionar amigo
      </h2>

      <form action="{{ route('amigos.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nome do usuário"
               class="flex-1 bg-[#03111d] text-white font-bold p-3.5 rounded-xl border-0 outline-none focus:ring-2 focus:ring-cyan-400">
        <button type="submit"
                class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-xl transition-all cursor-pointer">
          Adicionar
        </button>
      </form>
    </section>

    <section class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-4">
      <h2 class="text-xl font-black text-white">Ranking de XP</h2>

      @if($friends->isEmpty())
        <p class="text-center text-gray-400 font-bold py-6">
          Você ainda não adicionou ninguém.
        </p>
      @else
        <div class="overflow-x-auto rounded-2xl border-2 border-[#3598CA]">
          <table class="w-full text-left border-collapse">
            <thead>
            <tr class="bg-[#03111d] text-xs font-extrabold text-cyan-400 uppercase tracking-wider">
              <th class="px-4 py-3 border-b-2 border-r-2 border-[#3598CA]">#</th>
              <th class="px-4 py-3 border-b-2 border-r-2 border-[#3598CA]">Nome</th>
              <th class="px-4 py-3 border-b-2 border-r-2 border-[#3598CA] text-right">XP</th>
              <th class="px-4 py-3 border-b-2 border-[#3598CA]"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ranking as $i => $pessoa)
              @php $euMesmo = $pessoa->id === $user->id; @endphp
              <tr class="{{ $euMesmo ? 'bg-[#3598CA]' : 'bg-[#051d31]' }} text-white font-bold">
                <td class="px-4 py-3 border-r-2 border-[#3598CA] {{ $loop->last ? '' : 'border-b-2' }}">{{ $i + 1 }}</td>
                <td class="px-4 py-3 border-r-2 border-[#3598CA] {{ $loop->last ? '' : 'border-b-2' }}">
                  {{ $pessoa->name }}
                  @if($euMesmo) <span class="text-xs font-extrabold">(você)</span> @endif
                </td>
                <td class="px-4 py-3 border-r-2 border-[#3598CA] text-right {{ $loop->last ? '' : 'border-b-2' }}">{{ $pessoa->xp ?? 0 }} XP</td>
                <td class="px-4 py-3 text-right {{ $loop->last ? '' : 'border-b-2' }} border-[#3598CA]">
                  @unless($euMesmo)
                    <form action="{{ route('amigos.destroy', $pessoa) }}" method="POST"
                          onsubmit="return confirm('Remover {{ $pessoa->name }} dos amigos?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="text-cyan-400 hover:text-white cursor-pointer">
                        <i class='bx bx-trash text-lg'></i>
                      </button>
                    </form>
                  @endunless
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </section>
  </div>
</x-layout>
