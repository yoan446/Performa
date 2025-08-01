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
        Schema::create('sous_directions', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->unsignedBigInteger('chef_id')->nullable();
            $table->unsignedBigInteger('direction_id');
            $table->integer('nombre_employes')->default(0);
            $table->timestamps();

            // Clés étrangères
            $table->foreign('chef_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('direction_id')->references('id')->on('directions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sous_directions');
    }
};
