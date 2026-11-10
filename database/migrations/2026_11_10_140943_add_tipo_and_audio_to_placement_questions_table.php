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
        Schema::table('placement_questions', function (Blueprint $table) {
            $table->string('tipo')->default('escrita')->after('ordem');
            $table->string('audio')->nullable()->after('frase_portugues');
        });
    }

    public function down(): void
    {
        Schema::table('placement_questions', function (Blueprint $table) {
            $table->dropColumn(['tipo', 'audio']);
        });
    }
};
