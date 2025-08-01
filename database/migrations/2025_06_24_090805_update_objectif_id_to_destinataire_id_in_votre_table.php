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
        Schema::table('commentaires', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère
            $table->dropForeign(['objectif_id']);

            // Renommer la colonne
            $table->renameColumn('objectif_id', 'destinataire_id');
        });


         Schema::table('commentaires', function (Blueprint $table) {
            // Ajouter la nouvelle clé étrangère
            $table->foreign('destinataire_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commentaires', function (Blueprint $table) {
           // Supprimer la nouvelle contrainte
            $table->dropForeign(['destinataire_id']);

            // Renommer la colonne en arrière
            $table->renameColumn('destinataire_id', 'objectif_id');
        });

        Schema::table('commentaires', function (Blueprint $table) {
            // Restaurer l’ancienne clé étrangère
            $table->foreign('objectif_id')
                  ->references('id')
                  ->on('ancienne_table') // Remplace si ce n’était pas 'users'
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }
};
