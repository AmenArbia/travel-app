<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('type_rooms', function (Blueprint $table) {
            $table->json('pax capacity')->nullable();
            $table->json('adult capacity')->nullable();
            $table->json('children capacity')->nullable();
            $table->json('infants capacity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_rooms', function (Blueprint $table) {
            //
        });
    }
};