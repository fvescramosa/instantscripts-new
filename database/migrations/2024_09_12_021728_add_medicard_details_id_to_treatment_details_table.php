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
        Schema::table('treatment_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('medicare_card_details_id')->nullable(); // Add the column (nullable if necessary)
            $table->foreign('medicare_card_details_id')->references('id')->on('medicare_card_details')->onDelete('cascade'); // Add the foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('treatment_details', function (Blueprint $table) {
            //

        });
    }
};
