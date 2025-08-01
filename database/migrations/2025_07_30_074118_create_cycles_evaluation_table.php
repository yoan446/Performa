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
        Schema::create('cycles_evaluation', function (Blueprint $table) {
            $table->id('id_cycle');
            $table->string('titre');  
            $table->text('description');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('notation_max');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles_evaluation');
    }
};
