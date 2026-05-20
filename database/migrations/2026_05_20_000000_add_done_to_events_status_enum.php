<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('scheduled', 'cancelled', 'done') NOT NULL DEFAULT 'scheduled'");
    }

    public function down(): void
    {
        DB::statement("UPDATE events SET status = 'cancelled' WHERE status = 'done'");
        DB::statement("ALTER TABLE events MODIFY COLUMN status ENUM('scheduled', 'cancelled') NOT NULL DEFAULT 'scheduled'");
    }
};
