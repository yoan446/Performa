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
        Schema::table('users', function (Blueprint $table) {
            //ce que j'ai ajouté à la table existante
            $table->string('secondname');  // Nom de l'utilisateur
            $table->string('user_job_name');  // Nom du poste de l'utilisateur (ce qu'il a comme intutilé de poste)
            $table->foreignId('direction_id')->nulable()->constrained()->onDelete('set null'); 
            $table->string('statut_user');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
