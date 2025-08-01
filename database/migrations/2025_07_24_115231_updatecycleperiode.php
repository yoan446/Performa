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
        Schema::table('cycles', function (Blueprint $table) {
            // On rend les colonnes nullable pour ne pas bloquer les anciennes lignes
            $table->date('debut_cycle')->after('nom_cycle')->nullable();
            $table->date('fin_cycle')->after('debut_cycle')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cycles', function (Blueprint $table) {
            $table->dropColumn(['debut_cycle', 'fin_cycle']);
        });
    }
};
