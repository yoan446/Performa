<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('objectifs_users', function (Blueprint $table) {
            // Supprimer la clé étrangère si elle existe
            $constraint = DB::selectOne("
                SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE TABLE_NAME = 'objectifs_users'
                AND COLUMN_NAME = 'cycle_id'
                AND CONSTRAINT_SCHEMA = DATABASE()
                AND REFERENCED_TABLE_NAME IS NOT NULL
            ");

            if ($constraint) {
                $constraintName = $constraint->CONSTRAINT_NAME;
                DB::statement("ALTER TABLE objectifs_users DROP FOREIGN KEY `$constraintName`");
            }

            // Supprimer la colonne si elle existe
            if (Schema::hasColumn('objectifs_users', 'cycle_id')) {
                $table->dropColumn('cycle_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('objectifs_users', function (Blueprint $table) {
            $table->unsignedBigInteger('cycle_id')->nullable();

            $table->foreign('cycle_id')
                  ->references('id_cycle')
                  ->on('cycles_evaluation')
                  ->onDelete('cascade');
        });
    }
};
