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
        Schema::create('placement_questions', function (Blueprint $table) {
            $table->id();
            $table->string('nivel'); // A1, A2, B1, B2, C1, C2
            $table->integer('ordem'); // 1 a 3
            $table->string('tipo')->default('escrita'); // 'escrita' ou 'escuta'
            $table->text('frase_portugues')->nullable();
            $table->string('audio')->nullable(); // Caminho do arquivo de áudio (se for escuta)
            $table->text('resposta_correta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('placement_questions');
    }
};
