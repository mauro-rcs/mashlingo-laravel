<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-layout>
  <div x-data="placementQuiz(@js($questoes))" class="max-w-3xl mx-auto w-full space-y-6 my-8 px-4">

    <header class="bg-[#051d31] p-6 rounded-[2rem] shadow-2xl flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-black text-white">Teste de Nivelamento</h1>
        <p class="text-gray-300 font-semibold mt-1">Responda com atenção para definirmos seu nível (A1 a C2).</p>
      </div>
      <div class="bg-cyan-500/20 text-cyan-400 font-black px-4 py-2 rounded-2xl text-xs uppercase tracking-wider">
        Nível <span x-text="currentQuestion.nivel"></span>
      </div>
    </header>

    @if(session('error'))
      <div class="bg-red-500/20 text-red-300 font-bold px-4 py-3 rounded-2xl text-sm">
        {{ session('error') }}
      </div>
    @endif

    <form x-ref="form" action="{{ route('placement.submit') }}" method="POST">
      @csrf

      <template x-for="(ans, qId) in answers" :key="qId">
        <input type="hidden" :name="'answers[' + qId + ']'" :value="ans">
      </template>

      <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-6">

        <div class="flex items-center justify-between text-xs font-extrabold text-gray-400">
          <span>Questão <span x-text="currentIndex + 1"></span> de <span x-text="questions.length"></span></span>
          <div class="w-1/3 bg-[#03111d] h-2 rounded-full overflow-hidden">
            <div class="bg-cyan-400 h-full transition-all duration-300"
                 :style="'width: ' + (((currentIndex + 1) / questions.length) * 100) + '%'"></div>
          </div>
        </div>

        <div class="text-center space-y-4 py-4">
          <span class="inline-block bg-[#03111d] text-cyan-400 text-xs font-bold px-3 py-1 rounded-full"
                x-text="currentQuestion.audio ? 'Ouça e escreva o que você ouviu:' : 'Traduza a frase:'"></span>

          <h2 class="text-xl font-black text-white" x-text="currentQuestion.frase_portugues"></h2>

          <template x-if="currentQuestion.audio">
            <div class="flex justify-center pt-2">
              <audio controls :src="'/' + currentQuestion.audio" class="w-full max-w-md rounded-xl"></audio>
            </div>
          </template>
        </div>

        <div class="space-y-2">
          <input type="text"
                 x-model="userAnswer"
                 :disabled="submitting"
                 @keydown.enter.prevent="isLast ? finish() : nextQuestion()"
                 placeholder="Resposta em inglês"
                 autocomplete="off"
                 class="w-full bg-[#03111d] text-white text-sm font-semibold p-4 rounded-2xl border-0 outline-none focus:ring-2 focus:ring-cyan-400 shadow-inner">
        </div>

        <div class="pt-4 flex justify-end">
          <template x-if="!isLast">
            <button type="button"
                    @click="nextQuestion()"
                    :disabled="!userAnswer.trim()"
                    :class="{'opacity-50 cursor-not-allowed': !userAnswer.trim(), 'cursor-pointer hover:bg-[#2F8BB9]': userAnswer.trim()}"
                    class="bg-[#3598CA] text-white font-black px-6 py-3.5 rounded-2xl shadow-xl transition-all flex items-center gap-2">
              <span>Próxima Questão</span>
              <i class='bx bx-right-arrow-alt text-xl'></i>
            </button>
          </template>

          <template x-if="isLast">
            <button type="button"
                    @click="finish()"
                    :disabled="!userAnswer.trim() || submitting"
                    :class="{'opacity-50 cursor-not-allowed': !userAnswer.trim() || submitting, 'cursor-pointer hover:bg-green-500': userAnswer.trim() && !submitting}"
                    class="bg-green-600 text-white font-black px-8 py-3.5 rounded-2xl shadow-xl transition-all flex items-center gap-2">
              <span x-text="submitting ? 'Avaliando com IA...' : 'Finalizar Teste'"></span>
              <i class='bx bx-check-double text-xl'></i>
            </button>
          </template>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('placementQuiz', (questions) => ({
        questions: questions,
        currentIndex: 0,
        userAnswer: '',
        answers: {},
        submitting: false,

        get currentQuestion() {
          return this.questions[this.currentIndex] || {};
        },

        get isLast() {
          return this.currentIndex === this.questions.length - 1;
        },

        nextQuestion() {
          if (!this.userAnswer.trim()) return;

          this.answers[this.currentQuestion.id] = this.userAnswer.trim();
          this.userAnswer = '';

          if (!this.isLast) {
            this.currentIndex++;
          }
        },

        finish() {
          if (!this.userAnswer.trim() || this.submitting) return;

          this.answers[this.currentQuestion.id] = this.userAnswer.trim();
          this.submitting = true;

          // espera o Alpine criar os inputs hidden antes de enviar
          this.$nextTick(() => this.$refs.form.submit());
        }
      }));
    });
  </script>
</x-layout>
