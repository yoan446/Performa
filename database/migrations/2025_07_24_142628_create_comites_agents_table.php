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
        Schema::create('comites_agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comite_id');
            $table->unsignedBigInteger('user_id'); // agent_id mais on garde user_id car agents sont des users

            $table->foreign('comite_id')->references('id')->on('comites')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unique(['comite_id', 'user_id']); // éviter doublons
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comites_agents');
    }
};
