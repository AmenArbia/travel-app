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
        Schema::create('hotel_supplier', function (Blueprint $table) {
            $table->id();  // Primary key (auto-incrementing ID)
            $table->unsignedBigInteger('hotel_id');
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

            // Foreign keys (adjust as needed based on your table structure)
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};