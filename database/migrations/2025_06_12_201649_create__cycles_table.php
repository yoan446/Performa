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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_cycle'); 
    
            $table->date('debut_fixation');
            $table->date('fin_fixation');

            $table->date('debut_auto_eval');
            $table->date('fin_auto_eval');

            $table->date('debut_eval_manager');
            $table->date('fin_eval_manager');

            $table->date('debut_eval_comite');
            $table->date('fin_eval_comite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
