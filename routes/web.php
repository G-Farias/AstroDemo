<?php

use App\Http\Controllers\MedicalInsurenceController;
use App\Http\Controllers\MedicalInsurenceSpecialistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservedTurnController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SpecialtyController;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\ReservedTurn;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 

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
Route::middleware('can:isAdmin')->group(function (){
    Route::get('/especialistas/create', [SpecialistController::class, 'create'])->name('especialistas.create');
});
Route::middleware('auth')->group(function () {
    Route::get('/especialistas', [SpecialistController::class, 'index'])->name('especialistas.index');
    Route::post('/especialistas', [SpecialistController::class, 'store'])->name('especialistas.store');
    Route::get('/especialistas/{specialist}', [SpecialistController::class, 'show'])->name('especialistas.show');
    Route::get('/especialistas/{specialist}/edit', [SpecialistController::class, 'edit'])->name('especialistas.edit');
    Route::put('/especialistas/{specialist}', [SpecialistController::class, 'update'])->name('especialistas.update');
    Route::delete('/especialistas/{specialist}', [SpecialistController::class, 'destroy'])->name('especialistas.destroy');

    Route::get('especialistas/{specialist}/obras_sociales', [SpecialistController::class, 'obras_sociales'])->name('especialistas.obras_sociales');
    Route::post('especialistas/{specialist}/store_obras_sociales', [SpecialistController::class, 'store_obras_sociales'])->name('especialistas.store_obras_sociales');
    Route::delete('/especialistas/obra_social/{medicalInsurenceSpecialist}', [SpecialistController::class, 'destroy_obras_sociales'])->name('especialistas.obra_social_destroy');

    Route::get('especialistas/{specialist}/horario_atencion', [SpecialistController::class, 'horario_atencion'])->name('especialistas.horario_atencion');
    Route::post('especialistas/{specialist}/horario_atencion', [SpecialistController::class, 'horario_atencion'])->name('especialistas.horario_atencion');
    Route::post('especialistas/store_horario_atencion', [ScheduleController::class, 'store'])->name('especialistas.store_horario_atencion');
    Route::delete('/especialistas/horario_atencion/{schedule}', [ScheduleController::class, 'destroy_horario_atencion'])->name('especialistas.horario_atencion_destroy');

});

Route::middleware('auth')->group(function() {

    Route::get('/turno', [ReservedTurnController::class, 'index'])->name('turno.inicio');
    Route::post('/turno/resultados', [ReservedTurnController::class, 'index'])->name('turno.index');
    Route::post('/turno/resultados_especialidad', [ReservedTurnController::class, 'busqueda_especialidad'])->name('turno.busqueda_especialidad');


    Route::get('/turno/{schedule}/create', [ReservedTurnController::class, 'create'])->name('turno.create');
    Route::post('/turno', [ReservedTurnController::class, 'store'])->name('turno.store');
    
    Route::get('/turno/reservados', [ReservedTurnController::class, 'turnos_reservados'])->name('turno.reservados');
    Route::post('/turno/reservados_fecha', [ReservedTurnController::class, 'turnos_reservados_fecha'])->name('turno.reservados_fecha');
    Route::post('/turno/reservados_especialidad', [ReservedTurnController::class, 'turnos_reservados_especialidad'])->name('turno.reservados_especialidad');
    Route::post('/turno/reservados/{reservedturn}', [ReservedTurnController::class, 'turnos_reservados_update'])->name('turno.actualizar');


    Route::get('/turno/{reservedturn}', [ReservedTurnController::class, 'show'])->name('turno.show');
    Route::get('/turno/{reservedturn}/edit', [ReservedTurnController::class, 'edit'])->name('turno.edit');
    Route::put('/turno/{reservedturn}', [ReservedTurnController::class, 'update'])->name('turno.update');
    Route::delete('/turno/{reservedTurn}', [ReservedTurnController::class, 'destroy'])->name('turno.destroy');

});


Route::middleware('can:isAdmin')->group(function () {

    Route::get('/obraSocial', [MedicalInsurenceController::class, 'index'])->name('obraSocial.index');
    Route::get('/obraSocial/create', [MedicalInsurenceController::class, 'create'])->name('obraSocial.create');
    Route::post('/obraSocial', [MedicalInsurenceController::class, 'store'])->name('obraSocial.store');
    Route::get('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'show'])->name('obraSocial.show');
    Route::get('/obraSocial/{medicalInsurence}/edit', [MedicalInsurenceController::class, 'edit'])->name('obraSocial.edit');
    Route::put('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'update'])->name('obraSocial.update');
    Route::delete('/obraSocial/{medicalInsurence}', [MedicalInsurenceController::class, 'destroy'])->name('obraSocial.destroy');

});

Route::middleware('can:isAdmin')->group(function () {
    Route::get('/especialidad', [SpecialtyController::class, 'index'])->name('especialidad.index');
    Route::get('/especialidad/create', [SpecialtyController::class, 'create'])->name('especialidad.create');
    Route::post('/especialidad', [SpecialtyController::class, 'store'])->name('especialidad.store');
    Route::get('/especialidad/{specialty}', [SpecialtyController::class, 'show'])->name('especialidad.show');
    Route::get('/especialidad/{specialty}/edit', [SpecialtyController::class, 'edit'])->name('especialidad.edit');
    Route::put('/especialidad/{specialty}', [SpecialtyController::class, 'update'])->name('especialidad.update');
    Route::delete('/especialidad/{specialty}', [SpecialtyController::class, 'destroy'])->name('especialidad.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
