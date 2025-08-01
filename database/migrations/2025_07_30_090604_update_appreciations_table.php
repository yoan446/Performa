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
        Schema::table('appreciations', function (Blueprint $table) {
            // Ajouter la colonne id_cycle dans la table appreciations
            $table->unsignedBigInteger('id_cycle')->after('id'); // Après l'ID d'appréciation (à ajuster si nécessaire)

            // Ajouter la contrainte de clé étrangère qui fait référence à la colonne id_cycle de cycles_evaluation
            $table->foreign('id_cycle')->references('id_cycle')->on('cycles_evaluation')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appreciations', function (Blueprint $table) {
            // Supprimer la clé étrangère
            $table->dropForeign(['id_cycle']);
            
            // Supprimer la colonne id_cycle
            $table->dropColumn('id_cycle');
        });
    }
};
