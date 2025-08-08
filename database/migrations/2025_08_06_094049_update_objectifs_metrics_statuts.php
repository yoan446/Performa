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
            // Si les colonnes n'existent pas, on les crée directement
            if (!Schema::hasColumn('objectifs_users', 'metric')) {
                $table->unsignedBigInteger('metric')->nullable();
                $table->foreign('metric')->references('id')->on('metrics')->onDelete('restrict');
            }

            if (!Schema::hasColumn('objectifs_users', 'statut_objectif')) {
                $table->unsignedBigInteger('statut_objectif')->nullable();
                $table->foreign('statut_objectif')->references('id')->on('statuts')->onDelete('restrict');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objectifs_users', function (Blueprint $table) {
            if (Schema::hasColumn('objectifs_users', 'metric')) {
                $table->dropForeign(['metric']);
                $table->dropColumn('metric');
            }

            if (Schema::hasColumn('objectifs_users', 'statut_objectif')) {
                $table->dropForeign(['statut_objectif']);
                $table->dropColumn('statut_objectif');
            }
        });
    }
};
