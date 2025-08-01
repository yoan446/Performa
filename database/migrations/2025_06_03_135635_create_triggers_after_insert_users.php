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
        DB::unprepared('
            CREATE TRIGGER after_insert_user
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                IF NEW.direction_id IS NOT NULL THEN
                    UPDATE directions
                    SET employee_count = employee_count + 1
                    WHERE id = NEW.direction_id;
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       DB::unprepared('DROP TRIGGER IF EXISTS after_insert_user');
    }
};
