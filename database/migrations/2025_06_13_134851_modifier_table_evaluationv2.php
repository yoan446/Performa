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
            $table->string('note_auto_eval')->nullable()->change();
            $table->string('note_manager')->nullable()->change();
            $table->string('note_comite')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Evaluations', function (Blueprint $table) {
            $table->float('note_auto_eval')->nullable()->change();
            $table->float('note_manager')->nullable()->change();
            $table->float('note_comite')->nullable()->change();
        });
    }
};
