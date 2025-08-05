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
        Schema::dropIfExists('cycles');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('cycles', function ($table) {
            $table->id();
            $table->string('nom_cycle')->nullable();
            $table->date('debut_cycle')->nullable();
            $table->date('fin_cycle')->nullable();
            $table->date('debut_fixation')->nullable();
            $table->date('fin_fixation')->nullable();
            $table->date('debut_auto_eval')->nullable();
            $table->date('fin_auto_eval')->nullable();
            $table->date('debut_eval_manager')->nullable();
            $table->date('fin_eval_manager')->nullable();
            $table->date('debut_eval_comite')->nullable();
            $table->date('fin_eval_comite')->nullable();
            $table->timestamps();
        });
    }
};
