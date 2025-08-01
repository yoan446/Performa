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
        Schema::table('comites', function (Blueprint $table) {
            // D'abord, on supprime les contraintes de clé étrangère si elles existent
            if (Schema::hasColumn('comites', 'direction_id')) {
                $table->dropForeign(['direction_id']);
                $table->dropColumn('direction_id');
            }

            if (Schema::hasColumn('comites', 'sous_direction_id')) {
                $table->dropForeign(['sous_direction_id']);
                $table->dropColumn('sous_direction_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comites', function (Blueprint $table) {
            // Restaurer les colonnes (type int et nullable par défaut ici, à adapter si nécessaire)
            $table->unsignedBigInteger('direction_id')->nullable();
            $table->unsignedBigInteger('sous_direction_id')->nullable();

            // Restaurer les clés étrangères (adapter les noms de table si nécessaire)
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');
            $table->foreign('sous_direction_id')->references('id')->on('sous_directions')->onDelete('cascade');
        });
    }
};
