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
        Schema::create('Evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('objectif_id');
            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('comite_id')->nullable();
            $table->float('note_eval');
            $table->enum('appreciation', ['SG', 'NI', 'ME', 'EE', 'O']);
            $table->enum('type_evaluation', ['AutoEvaluation', 'EvaluationManager', 'EvaluationComite']);
            $table->timestamps();

            $table->foreign('objectif_id')->references('id')->on('objectifs_users')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('comite_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Evaluations');
    }
};
