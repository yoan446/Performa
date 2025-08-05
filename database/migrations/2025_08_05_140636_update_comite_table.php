<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('comites', function (Blueprint $table) {
            $table->unsignedBigInteger('cycle_id')->change();

            // Ajouter la bonne contrainte
            $table->foreign('cycle_id')
                  ->references('id_cycle')
                  ->on('cycles_evaluation')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('comites', function (Blueprint $table) {
            $table->dropForeign(['cycle_id']);

            $table->foreign('cycle_id')
                  ->references('id')
                  ->on('cycles')
                  ->onDelete('cascade');
        });
    }
};
