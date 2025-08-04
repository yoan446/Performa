<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodes_actions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_action');
            $table->unsignedBigInteger('cycle_id');

            // Colonnes pour gérer la période d'exécution
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();

            $table->timestamps();

            // Clé étrangère vers actions
            $table->foreign('id_action')
                ->references('id')
                ->on('actions')
                ->onDelete('cascade');

            // Clé étrangère vers cycles_evaluation (ou ta table cycle)
            $table->foreign('cycle_id')
                ->references('id_cycle') // adapte ici si ta clé primaire est 'id' ou 'id_cycle'
                ->on('cycles_evaluation')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodes_actions');
    }
};
