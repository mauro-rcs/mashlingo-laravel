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
        Schema::table('users', function (Blueprint $table) {
            $table->date('data_nasc')->nullable()->after('email');
            $table->string('bio', 100)->nullable()->after('password');
            $table->string('foto_perfil')->nullable()->after('bio');
            $table->integer('xp')->default(0)->after('foto_perfil');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['data_nasc', 'bio', 'foto_perfil', 'xp']);
        });
    }
};
