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
        Schema::create('writing_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // número da lição
            $table->unsignedInteger('lesson');

            // concluída?
            $table->boolean('completed')->default(false);

            // quando concluiu
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            // impede repetir a mesma lição para o mesmo usuário
            $table->unique(['user_id', 'lesson']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writing_progress');
    }
};
