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
         Schema::create('gauss', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comite_id')->constrained('comites')->onDelete('cascade');
            $table->foreignId('appreciation_id')->constrained('appreciations')->onDelete('cascade');
            $table->float('quota_max', 5, 2)->comment('Quota max en pourcentage');
            $table->timestamps();

            $table->unique(['comite_id', 'appreciation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gauss');
    }
};
