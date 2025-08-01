<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nom de la direction
            $table->string('chef')->nullable();  // Chef de direction, nullable
            $table->integer('employee_count')->default(0);  // Nombre d'employés, valeur par défaut
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('directions');
    }

};
