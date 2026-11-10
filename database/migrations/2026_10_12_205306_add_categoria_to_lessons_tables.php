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
        Schema::table('writing_lessons', function (Blueprint $table) {
            $table->string('categoria')->default('entretenimento')->after('xp');
        });

        Schema::table('listening_lessons', function (Blueprint $table) {
            $table->string('categoria')->default('entretenimento')->after('xp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('writing_lessons', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });

        Schema::table('listening_lessons', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};
