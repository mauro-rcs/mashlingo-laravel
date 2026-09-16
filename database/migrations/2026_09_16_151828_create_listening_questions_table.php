<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('listening_questions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('listening_lesson_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('ordem');
            $table->string('audio');
            $table->text('pergunta');

            $table->string('resposta_1');
            $table->string('resposta_2');
            $table->string('resposta_3');
            $table->string('resposta_4');

            $table->unsignedTinyInteger('resposta_correta');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listening_questions');
    }
};
