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
        Schema::create('periodes_evaluations', function (Blueprint $table) {
            $table->id(); // id auto-incrementé
            $table->unsignedBigInteger('id_cycle_eval'); // clé étrangère vers cycles_evaluation
            $table->string('nom_phase');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();

            // Définition de la contrainte de clé étrangère
            $table->foreign('id_cycle_eval')->references('id_cycle')->on('cycles_evaluation')->onDelete('cascade'); // en cas de suppression d'un cycle, supprime les périodes associées
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodes_evaluations');
    }
};
