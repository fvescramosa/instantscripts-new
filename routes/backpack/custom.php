<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('script', 'ScriptCrudController');
    Route::crud('patient', 'PatientCrudController');
    Route::crud('medical-consultation', 'MedicalConsultationCrudController');
    Route::crud('treatment-detail', 'TreatmentDetailCrudController');
    Route::crud('medicine-category', 'MedicineCategoryCrudController');
    Route::crud('medicare-card-details', 'MedicareCardDetailsCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
