<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('writing_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('writing_lesson_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('ordem');

            $table->text('frase_portugues');

            $table->text('resposta_correta');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('writing_questions');
    }
};
