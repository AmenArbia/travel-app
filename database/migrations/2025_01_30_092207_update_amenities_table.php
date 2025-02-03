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
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn(['type', 'other_type']);

        });
        Schema::table('amenities', function (Blueprint $table) {
            $table->enum('type', ['Instant', 'Internet', 'Kitchen', 'Bedroom', 'Living Area', 'Media and Technology', 'Other'])->after('description')->nullable();
            $table->string('other_type')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amenities', function (Blueprint $table) {
            $table->dropColumn(['type', 'other_type']);
        });
        Schema::table('amenities', function (Blueprint $table) {
            $table->enum('type', ['Instant', 'Internet', 'Kitchen', 'Bedroom', 'Living Area', 'Media and Technology', 'Other']);
            $table->string('other_type')->nullable();
        });
    }
};
