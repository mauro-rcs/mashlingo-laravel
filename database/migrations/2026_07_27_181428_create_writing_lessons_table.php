<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('writing_lessons', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('numero'); // aula 1,2,3...
            $table->string('titulo');
            $table->text('instrucao');

            $table->unsignedInteger('xp')->default(10);

            $table->timestamps();

            $table->unique('numero');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('writing_lessons');
    }
};
