<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WritingLesson;
use App\Models\WritingQuestion;

class WritingLessonSeeder extends Seeder
{
    public function run(): void
    {
        $lesson = WritingLesson::create([
            'numero' => 1,
            'titulo' => 'Pronomes pessoais',
            'instrucao' => 'Escreva a frase em inglês.',
            'xp' => 20,
        ]);

        WritingQuestion::create([
            'writing_lesson_id' => $lesson->id,
            'ordem' => 1,
            'frase_portugues' => 'Eu gosto de estudar.',
            'resposta_correta' => 'I like to study.',
        ]);

        WritingQuestion::create([
            'writing_lesson_id' => $lesson->id,
            'ordem' => 2,
            'frase_portugues' => 'Ela é minha amiga.',
            'resposta_correta' => 'She is my friend.',
        ]);

        WritingQuestion::create([
            'writing_lesson_id' => $lesson->id,
            'ordem' => 3,
            'frase_portugues' => 'Nós moramos no Brasil.',
            'resposta_correta' => 'We live in Brazil.',
        ]);
    }
}
