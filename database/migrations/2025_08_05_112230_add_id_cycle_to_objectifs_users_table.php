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
        Schema::table('objectifs_users', function (Blueprint $table) {
            // Ajouter la colonne après 'statut_objectif'
            $table->unsignedBigInteger('id_cycle')->after('statut_objectif');

            // Ajouter la contrainte de clé étrangère vers cycles_evaluation.id_cycle
            $table->foreign('id_cycle')
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
        Schema::table('objectifs_users', function (Blueprint $table) {
            // Supprimer la contrainte d'abord
            $table->dropForeign(['id_cycle']);

            // Supprimer la colonne
            $table->dropColumn('id_cycle');
        });
    }
};
