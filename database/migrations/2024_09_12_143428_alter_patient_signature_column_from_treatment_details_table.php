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
            $table->longText('patient_signature')->change(); // Change to TEXT if you expect long data
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
