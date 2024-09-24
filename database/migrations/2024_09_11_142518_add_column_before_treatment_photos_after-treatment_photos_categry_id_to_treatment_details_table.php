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
            $table->string('before_treatment_photos')->nullable()->after('treatment_photos'); // For storing file paths to treatment photos
            $table->string('after_treatment_photos')->nullable()->after('before_treatment_photos'); // For storing file paths to treatment photos
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
