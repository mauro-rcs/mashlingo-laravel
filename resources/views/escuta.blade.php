<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-layout>
    <div x-data="listeningQuiz({{ json_encode($lesson->questions) }})" class="max-w-3xl mx-auto w-full space-y-6 my-8 px-4">
        <header class="bg-[#051d31] p-6 rounded-[2rem] shadow-2xl flex items-center justify-between">
            <div>
                <span class="text-xs font-black text-cyan-400 uppercase tracking-widest">Aula {{ $lesson->numero }}</span>
                <h1 class="text-2xl font-black text-white">{{ $lesson->titulo }}</h1>
                <p class="text-xs text-gray-300 font-semibold mt-1">{{ $lesson->instrucao }}</p>
            </div>
            <div class="text-cyan-500 font-black px-4 py-2 rounded-2xl text-sm">
                {{ $lesson->xp }} XP
            </div>
        </header>

        <div class="bg-[#051d31] p-6 md:p-8 rounded-[2.5rem] shadow-2xl space-y-6">
            <div class="flex items-center justify-between text-xs font-extrabold text-gray-400">
                <span>Questão <span x-text="currentIndex + 1"></span> de <span x-text="questions.length"></span></span>
                <div class="w-1/3 bg-[#03111d] h-2 rounded-full overflow-hidden">
                    <div class="bg-cyan-400 h-full transition-all duration-300" :style="'width: ' + (((currentIndex + 1) / questions.length) * 100) + '%'"></div>
                </div>
            </div>

            <div class="text-center space-y-4 py-4">
                <h2 class="text-xl font-black text-white" x-text="currentQuestion.pergunta"></h2>

                <template x-if="currentQuestion.audio">
                    <div class="flex justify-center pt-2">
                        <audio controls :src="'/' + currentQuestion.audio" class="w-full max-w-md rounded-xl"></audio>
                    </div>
                </template>
            </div>

            <div class="grid grid-cols-1 gap-3">
                <template x-for="i in 4" :key="i">
                    <button
                        @click="selectOption(i)"
                        :disabled="selectedOption !== null"
                        :class="{
              'bg-[#03111d] text-white hover:bg-white/10': selectedOption === null,
              'bg-cyan-500 text-white font-bold': selectedOption !== null && i === currentQuestion.resposta_correta,
              'bg-cyan-800 text-white font-bold': selectedOption === i && i !== currentQuestion.resposta_correta,
              'opacity-40': selectedOption !== null && i !== currentQuestion.resposta_correta && selectedOption !== i
            }"
                        class="p-4 rounded-2xl font-semibold text-left transition-all border border-white/5 flex items-center justify-between cursor-pointer">
                        <span x-text="currentQuestion['resposta_' + i]"></span>
                        <i x-show="selectedOption !== null && i === currentQuestion.resposta_correta" class='bx bx-check-circle text-xl'></i>
                        <i x-show="selectedOption === i && i !== currentQuestion.resposta_correta" class='bx bx-x-circle text-xl'></i>
                    </button>
                </template>
            </div>

            <div x-show="selectedOption !== null" class="pt-4 flex justify-end">
                <button @click="nextQuestion()" class="bg-[#3598CA] hover:bg-[#2F8BB9] text-white font-black px-6 py-3 rounded-2xl shadow-xl transition-all cursor-pointer flex items-center gap-2">
                    <span x-text="currentIndex < questions.length - 1 ? 'Próxima Questão' : 'Finalizar Lição'"></span>
                    <i class='bx bx-right-arrow-alt text-xl'></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('listeningQuiz', (questions) => ({
                questions: questions,
                currentIndex: 0,
                selectedOption: null,

                get currentQuestion() {
                    return this.questions[this.currentIndex];
                },

                selectOption(index) {
                    this.selectedOption = index;
                },

                nextQuestion() {
                    if (this.currentIndex < this.questions.length - 1) {
                        this.currentIndex++;
                        this.selectedOption = null;
                    } else {
                        window.location.href = "{{ route('site.taskboard') }}";
                    }
                }
            }));
        });
    </script>
</x-layout>
