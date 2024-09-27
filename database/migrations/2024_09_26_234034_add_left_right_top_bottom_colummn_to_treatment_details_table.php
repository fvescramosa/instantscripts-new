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
            $table->string('left_treatment_photos')->nullable()->after('treatment_photos'); // For storing file paths to treatment photos
            $table->string('right_treatment_photos')->nullable()->after('left_treatment_photos'); // For storing file paths to treatment photos
            $table->string('top_treatment_photos')->nullable()->after('right_treatment_photos'); // For storing file paths to treatment photos
            $table->string('bottom_treatment_photos')->nullable()->after('top_treatment_photos'); // For storing file paths to treatment photos
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
