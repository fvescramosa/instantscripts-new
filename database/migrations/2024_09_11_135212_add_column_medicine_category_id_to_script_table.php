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
        Schema::table('scripts', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('medicine_category_id')->nullable(); // Add the column (nullable if necessary)
            $table->foreign('medicine_category_id')->references('id')->on('medicine_categories')->onDelete('cascade'); // Add the foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scripts', function (Blueprint $table) {
            //
        });
    }
};
