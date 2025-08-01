<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remplace les colonnes de notes textuelles
     * par des clés étrangères vers appreciations.id.
     */
    public function up(): void
    {
        Schema::table('Evaluations', function (Blueprint $table) {
            /* 1. Supprimer les anciennes colonnes */
            if (Schema::hasColumn('evaluations', 'note_auto_eval')) {
                $table->dropColumn(['note_auto_eval', 'note_manager', 'note_comite']);
            }

            /* 2. Ajouter les nouvelles FK vers appreciations */
            $table->foreignId('note_auto_id')
                  ->nullable()
                  ->constrained('appreciations')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('note_manager_id')
                  ->nullable()
                  ->constrained('appreciations')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('note_comite_id')
                  ->nullable()
                  ->constrained('appreciations')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();
        });
    }

    /**
     * Revient à l’ancien schéma :
     *  - supprime les FK
     *  - recrée les colonnes textuelles de note
     */
    public function down(): void
    {
        Schema::table('Evaluations', function (Blueprint $table) {
            /* 1. Supprimer les trois FK */
            $table->dropForeign(['note_auto_id']);
            $table->dropForeign(['note_manager_id']);
            $table->dropForeign(['note_comite_id']);

            /* 2. Supprimer les colonnes FK */
            $table->dropColumn(['note_auto_id', 'note_manager_id', 'note_comite_id']);

            /* 3. Recréer les anciennes colonnes (type string ici) */
            $table->string('note_auto_eval')->nullable();
            $table->string('note_manager')->nullable();
            $table->string('note_comite')->nullable();
        });
    }
};
