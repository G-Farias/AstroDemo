<?php

use App\Http\Controllers\MedicalInsurenceController;
use App\Http\Controllers\MedicalInsurenceSpecialistController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicUserController;
use App\Http\Controllers\ReservedTurnController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpecialistController;
use App\Http\Controllers\SpecialtyController;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\PublicUser;
use App\Models\ReservedTurn;
use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate; 
use App\Notifications\turnMail;

use App\Models\Schedule;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\PDFController;

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


Route::middleware('auth')->group(function() {

    Route::get('/generate-patient-pdf', [PDFController::class, 'generatePDF'])->name('generate-patient-pdf');
    Route::get('/generate-turn-pdf', [PDFController::class, 'generateTurnPDF'])->name('generate-turn-pdf');
    Route::get('/generate-turn-hoy', [PDFController::class, 'generateTurnTodayPDF'])->name('generate-turn-hoy');
   

    /* EXPORTAR EXCEL */ 
    Route::get('patients/export/', [PatientController::class, 'export'])->name('export-patient');
    Route::get('reservedTurn/export/', [ReservedTurnController::class, 'export'])->name('export-turn');
   
    /*--------------*/ 
});
    Route::get('/generate-comprobante/{RT}', [PDFController::class, 'generateComprobante'])->name('generate-comprobante');


Route::get('/', function () {
    
    return view('welcome');
});

Route::get('/bienvenido', function(){
    return view('welcome');
});

Route::get('/ayuda', function () {
    return view('help');
})->middleware(['auth', 'verified'])->name('ayuda');

Route::get('/notificar', function(){

    //ELIMINAR PASADO 
    /*
    $eliminarTurnos = Schedule::whereDate('fecha_atencion', '<', now()->subDays(1))->get();
    foreach($eliminarTurnos as $eliminarTurno){

    ReservedTurn::where('id_horario_atencion', $eliminarTurno->id)->delete();
    }
    Schedule::whereDate('fecha_atencion', '<', now()->subDays(1))->delete();
    */
    //-------------------------------------------------

    //NOTIFICAR TURNO POR MAIL
    $turns = Schedule::where('estado','1')->whereDate('fecha_atencion','=', now()->addDays(2))->get();

    foreach($turns as $turn){
        $reservedTurns = ReservedTurn::where('id_horario_atencion', $turn->id)->where('notificacion', null)->get();

        foreach($reservedTurns as $reservedTurn){
            Notification::route('mail',$reservedTurn->email)->notify(new turnMail($reservedTurn));
            
            $turnoReservado = ReservedTurn::find($reservedTurn->id);
            $turnoReservado->notificacion = '1';
            $turnoReservado->save();
            
        }
    
    }
});
        //---------------------------------------------------
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
*/

Route::get('/pacientes', function () {
    return view('pacientes\pacientes');
})->middleware(['auth', 'verified'])->name('pacientes');

Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [ReservedTurnController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/{reservedturn}', [ReservedTurnController::class, 'turnos_reservados_update'])->name('turno.actualizar');

});

Route::middleware('auth')->group(function () {

    Route::get('/pacientes', [PatientController::class, 'index'])->name('pacientes.index');
  //  Route::post('/pacientes/buscar', [PatientController::class, 'buscar'])->name('pacientes.buscar');
    Route::get('/pacientes/buscar', [PatientController::class, 'buscar'])->name('pacientes.buscar');

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
    Route::post('/especialistas/horariosDeAtencion/{specialist}', [ScheduleController::class, 'destroy_horario_all_atencion'])->name('especialistas.horariosDeAtencion_destroy');

});

Route::middleware('auth')->group(function() {

    Route::get('/turno', [ReservedTurnController::class, 'inicio'])->name('turno.inicio');

    Route::get('/turno/resultado_fecha', [ReservedTurnController::class, 'busqueda_fecha'])->name('turno.busqueda_fecha');    
    Route::get('/turno/resultados_especialidad', [ReservedTurnController::class, 'busqueda_especialidad'])->name('turno.busqueda_especialidad');
    Route::get('/turno/resultados_especialista', [ReservedTurnController::class, 'busqueda_especialista'])->name('turno.busqueda_especialista');


    Route::get('/turno/{schedule}/create', [ReservedTurnController::class, 'create'])->name('turno.create');
    Route::post('/turno', [ReservedTurnController::class, 'store'])->name('turno.store');
    
    Route::get('/turno/reservados', [ReservedTurnController::class, 'turnos_reservados'])->name('turno.reservados');
    Route::get('/turno/reservados_fecha', [ReservedTurnController::class, 'turnos_reservados_fecha'])->name('turno.reservados_fecha');
    Route::get('/turno/reservados_especialista', [ReservedTurnController::class, 'turnos_reservados_especialista'])->name('turno.reservados_especialista');
    Route::get('/turno/reservados_dni', [ReservedTurnController::class, 'turnos_reservados_dni'])->name('turno.reservados_dni');
   
    Route::put('/turno/reservados/{reservedTurn}',[ReservedTurnController::class, 'turnos_reservados_act_estado'])->name('turno.actualizar_estado');
    Route::put('/turno/reservados/observacion/{reservedturn}', [ReservedTurnController::class, 'turnos_reservados_act_observacion'])->name('turno.actualizar_observacion');


    Route::get('/turno/{reservedturn}', [ReservedTurnController::class, 'show'])->name('turno.show');
    Route::get('/turno/{reservedturn}/edit', [ReservedTurnController::class, 'edit'])->name('turno.edit');
    Route::put('/turno/{reservedturn}', [ReservedTurnController::class, 'update'])->name('turno.update');
    Route::delete('/turno/{reservedTurn}', [ReservedTurnController::class, 'destroy'])->name('turno.destroy');
    Route::delete('/turno/ver-mas/{reservedTurn}', [ReservedTurnController::class, 'destroy_turno'])->name('turno.destroy_turno');

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

    Route::get('/reservarTurno', [PublicUserController::class, 'index'])->name('reservarTurno.especialidades');
    Route::get('/reservarTurno/especialista/{STY}', [PublicUserController::class, 'especialista'])->name('reservarTurno.especialistas');
    Route::get('/reservarTurno/turnos/{SST}', [PublicUserController::class, 'turnos'])->name('reservarTurno.turnos');
    Route::get('/reservarTurno/turnos_fecha/{SST}', [PublicUserController::class, 'buscar_turno_fecha'])->name('reservarTurno.turnos_fecha');
    Route::get('/reservarTurno/reservar/{SLE}',[PublicUserController::class,'reservar'])->name('reservarTurno.reservar');
    Route::post('/reservarTurno', [PublicUserController::class, 'store'])->name('reservarTurno.store');
    Route::get('/reservarTurno/turnoReservado/{RT}',[PublicUserController::class,'turno_reservado'])->name('reservarTurno.turnoReservado');


    Route::get('/reservarTurno/misTurnos', [PublicUserController::class, 'mis_turnos'])->name('reservarTurno.misTurnos');
    Route::post('/reservarTurno/misTurnos', [PublicUserController::class, 'mis_turnos'])->name('reservarTurno.misTurnos');
    Route::delete('/reservarTurno/{reservedTurn}', [PublicUserController::class, 'destroy'])->name('reservarTurno.destroy');

    Route::delete('/reservarTurno/cancel/{reservedTurn}', [PublicUserController::class, 'cancelar'])->name('reservarTurno.cancelar');


require __DIR__.'/auth.php';
