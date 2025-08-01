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
        Schema::table('directions', function (Blueprint $table) {
            // changer la colonne chef en clé étrangère
            $table->unsignedBigInteger('chef')->nullable()->change();
            $table->foreign('chef')->references('id')->on('users')->onDelete('set null');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('directions', function (Blueprint $table) {
            $table->dropForeign(['chef']);
            $table->string('chef')->nullable()->change();
        });
    }
};
