<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE TRIGGER update_enclosure_status 
        AFTER INSERT ON enclosure_allocations
        FOR EACH ROW
        BEGIN
            UPDATE enclosures 
            SET current_count = (
                SELECT COUNT(*) 
                FROM enclosure_allocations 
                WHERE enclosure_id = NEW.enclosure_id
            ),
            status = CASE 
                WHEN capacity < current_count THEN \'overload\'
                WHEN capacity = current_count THEN \'critical\'
                ELSE \'normal\'
            END
            WHERE id = NEW.enclosure_id;
        END
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_enclosure_status');
    }
};
