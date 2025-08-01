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
        Schema::create('objectifs_users', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('description');
            $table->enum('metric', ['Pourcentage', 'Score', 'Nombre', 'Temps'])->default('Pourcentage');
            $table->integer('valeur');
            $table->integer('poids');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut_objectif', ['En Attente de Validation', 'Valider', 'Realiser', 'Rejeter'])->default('En Attente de Validation');
            
            // Ajouter les colonnes manager_id et agent_id pour les relations avec les utilisateurs
            $table->foreignId('manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objectifs_users');
    }
};
