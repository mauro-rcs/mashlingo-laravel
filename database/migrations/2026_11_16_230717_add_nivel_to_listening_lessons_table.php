<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('listening_lessons', function (Blueprint $table) {
            $table->string('nivel', 2)->default('A1')->after('categoria');
        });
    }

    public function down(): void
    {
        Schema::table('listening_lessons', function (Blueprint $table) {
            $table->dropColumn('nivel');
        });
    }
};
