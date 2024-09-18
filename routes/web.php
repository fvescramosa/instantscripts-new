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
    Route::get('script/1/generate-pdf', [\App\Http\Controllers\Admin\ScriptController::class, 'generatePDF']);
});


Route::group(['prefix' => 'admin'], function () {
    Route::post('script/fetch/medicine-category', [\App\Http\Controllers\Admin\ScriptCrudController::class, 'fetchCategory'])->name('admin.script.fetch.medicine-category');
});
