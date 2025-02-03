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
            $table->dropColumn('pax capacity');
            $table->dropColumn('adult capacity');
            $table->dropColumn('children capacity');
            $table->dropColumn('infants capacity');
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