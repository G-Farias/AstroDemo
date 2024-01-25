<?php

use App\Http\Controllers\MedicalInsurenceController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialistController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/pacientes', function () {
    return view('pacientes\pacientes');
})->middleware(['auth', 'verified'])->name('pacientes');

Route::middleware('auth')->group(function () {

    Route::get('/pacientes', [PatientController::class, 'index'])->name('pacientes.index');
    Route::get('/pacientes/create', [PatientController::class, 'create'])->name('pacientes.create');
    Route::post('/pacientes', [PatientController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/{patient}', [PatientController::class, 'show'])->name('pacientes.show');
    Route::get('/pacientes/{patient}/edit', [PatientController::class, 'edit'])->name('pacientes.edit');
    Route::put('/pacientes/{patient}', [PatientController::class, 'update'])->name('pacientes.update');
    Route::delete('/pacientes/{patient}', [PatientController::class, 'destroy'])->name('pacientes.destroy');

});

Route::middleware('auth')->group(function () {

    Route::get('/especialistas', [SpecialistController::class, 'index'])->name('especialistas.index');
    Route::get('/especialistas/create', [SpecialistController::class, 'create'])->name('especialistas.create');
    Route::post('/especialistas', [SpecialistController::class, 'store'])->name('especialistas.store');
    Route::get('/especialistas/{specialist}', [SpecialistController::class, 'show'])->name('especialistas.show');
    Route::get('/especialistas/{specialist}/edit', [SpecialistController::class, 'edit'])->name('especialistas.edit');
    Route::put('/especialistas/{specialist}', [SpecialistController::class, 'update'])->name('especialistas.update');
    Route::delete('/especialistas/{specialist}', [SpecialistController::class, 'destroy'])->name('especialistas.destroy');

});

Route::middleware('auth')->group(function () {

    Route::get('/obraSocial', [MedicalInsurenceController::class, 'index'])->name('obraSocial.index');
    Route::get('/obraSocial/create', [MedicalInsurenceController::class, 'create'])->name('obraSocial.create');
    Route::post('/obraSocial', [MedicalInsurenceController::class, 'store'])->name('obraSocial.store');
    Route::get('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'show'])->name('obraSocial.show');
    Route::get('/obraSocial/{medicalInsurence}/edit', [MedicalInsurenceController::class, 'edit'])->name('obraSocial.edit');
    Route::put('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'update'])->name('obraSocial.update');
    Route::delete('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'destroy'])->name('obraSocial.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
