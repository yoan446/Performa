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
       Schema::table('Evaluations', function (Blueprint $table) {
            // Supprimer la clé étrangère existante sur comite_id
            $table->dropForeign(['comite_id']);
            // Optionnel : si tu veux, tu peux changer le type ou attributs de la colonne ici
            
            // Ajouter la nouvelle clé étrangère vers comites.id
            $table->foreign('comite_id')->references('id')->on('comites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Evaluations', function (Blueprint $table) {
            // Supprimer la clé étrangère sur comite_id (qui pointe vers comites)
            $table->dropForeign(['comite_id']);
            // Remettre l'ancienne clé étrangère vers users.id si nécessaire
            $table->foreign('comite_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
