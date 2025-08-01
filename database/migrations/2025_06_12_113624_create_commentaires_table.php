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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluation_id')->nullable();
            $table->unsignedBigInteger('objectif_id')->nullable();
            $table->unsignedBigInteger('auteur_id'); 
            $table->string('role_auteur');
            $table->text('message');
            $table->timestamps();

            $table->foreign('evaluation_id')->references('id')->on('Evaluations')->onDelete('cascade');
            $table->foreign('objectif_id')->references('id')->on('objectifs_users')->onDelete('cascade');
            $table->foreign('auteur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};
