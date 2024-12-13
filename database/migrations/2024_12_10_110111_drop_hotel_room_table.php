<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the 'hotel_room' table
        Schema::dropIfExists('hotel_room');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If you need to recreate the 'hotel_room' table, you can add the original code here
        // to recreate the table. For now, we leave it empty as dropping a table is irreversible.
    }
};