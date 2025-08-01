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
            // Suppression des colonnes existantes
            $table->dropColumn(['note_eval', 'appreciation', 'type_evaluation']);

            // Ajout des nouvelles colonnes nullable
            $table->float('note_auto_eval')->nullable()->after('objectif_id');
            $table->float('note_manager')->nullable()->after('note_auto_eval');
            $table->float('note_comite')->nullable()->after('note_manager');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('Evaluations', function (Blueprint $table) {
            // Ajout des anciennes colonnes (suppositions sur types)
            $table->float('note_eval')->nullable()->after('objectif_id');
            $table->text('appreciation')->nullable()->after('note_eval');
            $table->string('type_evaluation')->nullable()->after('appreciation');

            // Suppression des nouvelles colonnes
            $table->dropColumn(['note_auto_eval', 'note_manager', 'note_comite']);
        });
    }
};
