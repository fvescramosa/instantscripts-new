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
        Schema::create('treatment_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('script_id')->constrained('scripts')->onDelete('cascade');
            $table->integer('quantity')->nullable();
            $table->string('location', '255');
            $table->string('extra_notes', '500');
            $table->longText('deposit_details')->nullable();
            $table->longText('deposit_refund')->nullable();
            $table->longText('follow_up_payment')->nullable();
            $table->longText('possible_expenses')->nullable();
            $table->string('treatment_photos')->nullable(); // For storing file paths to treatment photos
            $table->boolean('consent_to_photographs')->default(false); // For storing consent to photographs
            $table->boolean('consent_to_treatment')->default(false); // For storing consent to treatment
            $table->string('patient_signature')->nullable(); // For storing file paths to patient signature images
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_details');
    }
};
