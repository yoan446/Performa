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
        Schema::table('evaluations', function (Blueprint $table) {
            // Modifier le type en unsignedBigInteger (important pour la clé étrangère)
            $table->unsignedBigInteger('Cycle_id')->change();

            // Supprimer l'ancienne contrainte étrangère si elle existe
            $table->dropForeign(['Cycle_id']);

            // Ajouter la nouvelle contrainte vers cycles_evaluation(id_cycle)
            $table->foreign('Cycle_id')
                  ->references('id_cycle')
                  ->on('cycles_evaluation')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['Cycle_id']);

            $table->foreign('Cycle_id')
                  ->references('id')
                  ->on('cycles')
                  ->onDelete('cascade');
        });
    }
};
