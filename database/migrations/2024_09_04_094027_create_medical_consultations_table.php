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
        Schema::create('medical_consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('script_id')->constrained('scripts')->onDelete('cascade');
            $table->date('consultation_date');
            $table->boolean('serious_health_problems')->default(false);
            $table->boolean('epilepsy_seizures_fainting')->default(false);
            $table->boolean('autoimmune_disease')->default(false);
            $table->boolean('surgery_history')->default(false);
            $table->boolean('medications_supplements')->default(false);
            $table->boolean('myasthenia_gravis')->default(false);
            $table->boolean('cold_sores')->default(false);
            $table->boolean('pregnant_breastfeeding')->default(false);
            $table->boolean('allergic_anything')->default(false);
            $table->boolean('sensitive_bees')->default(false);
            $table->boolean('numbing_injection')->default(false);
            $table->boolean('keloid_scarring')->default(false);
            $table->boolean('intend_to_surgical_invasive')->default(false);
            $table->boolean('implants')->default(false);
            $table->boolean('vaccination')->default(false);
            $table->boolean('tropical_treatment')->default(false);
            $table->boolean('anti_wrinkle')->default(false);
            $table->boolean('dermal_fillers')->default(false);
            $table->boolean('stimulatory_fillers')->default(false);
            $table->boolean('injectable_procedure')->default(false);
            $table->boolean('smoke')->default(false);
            $table->boolean('travel')->default(false);
            $table->boolean('appearance')->default(false);
            $table->boolean('affected_daily_life')->default(false);
            $table->boolean('avoid_gatherings')->default(false);
            $table->boolean('thinking_look')->default(false);
            $table->boolean('life_adversely')->default(false);
            $table->boolean('before_after')->default(false);
            $table->boolean('fully_consent')->default(false);
            $table->boolean('understand')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_consultations');
    }
};
