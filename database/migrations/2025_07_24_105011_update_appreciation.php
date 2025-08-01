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
            $table->decimal('valeur_min', 8, 2)->nullable()->after('description'); // Ajoute après 'id' ou une autre colonne selon ton besoin
            $table->decimal('valeur_max', 8, 2)->nullable()->after('valeur_min');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appreciations', function (Blueprint $table) {
            $table->dropColumn(['valeur_min', 'valeur_max']);
        });
    }
};
