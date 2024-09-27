<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Route::post('script/fetch/patient', [\App\Http\Controllers\Admin\ScriptCrudController::class, 'fetchPatient'])->name('admin.script.fetch.patient');
    Route::post('medicare-card-details/fetch/patient', [\App\Http\Controllers\Admin\MedicareCardDetailsCrudController::class, 'fetchPatient'])->name('admin.medicare-card-details.fetch.patient');
    Route::post('fetch-medicare-card-details', [\App\Http\Controllers\Admin\ScriptCrudController::class, 'fetchMedicareCardDetails']);
    Route::get('script/{id}/generate-pdf', [\App\Http\Controllers\Admin\ScriptController::class, 'generatePDF']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::post('script/fetch/medicine-category', [\App\Http\Controllers\Admin\ScriptCrudController::class, 'fetchCategory'])->name('admin.script.fetch.medicine-category');
    Route::get('/doctor-approval/', [\App\Http\Controllers\DoctorApprovalController::class, 'index'])->name('doctor-approval');
    Route::get('/doctor-approval/view/{id}', [\App\Http\Controllers\DoctorApprovalController::class, 'show'])->name('doctor-approval.view');
});
