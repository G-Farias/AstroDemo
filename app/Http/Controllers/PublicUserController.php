<?php

namespace App\Http\Controllers;

use App\Models\PublicUser;
use App\Models\Specialist;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\MedicalInsurence;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\ReservedTurn;
use Illuminate\Console\View\Components\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use PhpParser\Node\Stmt\Return_;

use Illuminate\Support\Facades\Crypt;
use Vinkla\Hashids\Facades\Hashids;


class PublicUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialtys = Specialty::orderBy('nombre_especialidad','asc')->get();

        return view('reservarTurno.especialidades', compact('specialtys'));
    }

    public function especialista($STY)
    {
        $specialty = Crypt::decrypt($STY);

        $specialists = Specialist::where('especialidad', $specialty->id)->get();

        $medicalInsurenceSpecialists = MedicalInsurenceSpecialist::get();

        return view('reservarTurno.especialista', compact('specialists','specialty','medicalInsurenceSpecialists'));
    }

    public function turnos($SST, Request $request)
    {
        $specialist = Crypt::decrypt($SST);

        $specialists = Specialist::where('id', $specialist)->get();
        $schedules = Schedule::where('id_especialista',$specialist->id)->whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->take(20)->get();
        
        return view('reservarTurno.turnos', compact('specialists','schedules','specialist'));
    }

    public function buscar_turno_fecha($SST, Request $request){

        $specialist = Crypt::decrypt($SST);

        $specialists = Specialist::where('id', $specialist)->get();
        $schedules = Schedule::where('id_especialista',$specialist->id)->where('fecha_atencion', $request->fecha_busqueda)->whereDate('fecha_atencion','>=', now())->orderBy('hr_atencion','asc')->get();
        
        return view('reservarTurno.turnos', compact('specialists','schedules','specialist'));
    }

    public function reservar($SSL)
    {
        $schedule = Crypt::decrypt($SSL);

        $specialists = Specialist::where('id',$schedule->id_especialista)->get();
        $schedules = Schedule::where('id',$schedule->id)->get();
        $medicalInsurence = MedicalInsurence::all();

        $medicalInsurenceSpecialist = MedicalInsurenceSpecialist::where('id_especialista', $schedule->id_especialista)->get();

        return view('reservarTurno.reservar', compact('schedules','specialists','medicalInsurenceSpecialist','medicalInsurence'));
    }

    public function turno_reservado($RT, Schedule $schedule){


        $schedules = Schedule::whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();

        $reservedTurn = Crypt::decrypt($RT);
        return view('reservarTurno.turnoReservado', compact('reservedTurn','schedule','schedules'));
    }

    public function store(Request $request)
    {
        $q_turnos = ReservedTurn::where('id_horario_atencion', $request->id_horario)->count();

       if ($request->dni == $request->dni_rep && $request->estado == '0' && $q_turnos < '1') {
       

        $reservedTurn = new ReservedTurn;

        $reservedTurn->nombre = $request->nombre;
        $reservedTurn->apellido = $request->apellido;
        $reservedTurn->dni = $request->dni;
        $reservedTurn->celular = $request->celular;
        $reservedTurn->email = $request->email;
        $reservedTurn->obra_social = $request->obra_social;
        $reservedTurn->numero_obraSocial = $request->numero_obraSocial;
        $reservedTurn->id_horario_atencion = $request-> id_horario;
        $reservedTurn->estado = '1';

        $reservedTurn->save();

        $schedule = Schedule::find($request->id_horario);
        $schedule->estado = '1';

        $schedule->save();

        /*
        return redirect()->route('reservarTurno.especialidades')->with('success', 'Turno reservado');
        */
        $RT = Crypt::encrypt($reservedTurn); 
        return redirect()->route('reservarTurno.turnoReservado', $RT)->with('success', 'Turno reservado');

        } else {
            return back()->with('danger', 'D.N.I / Pasaporte no coinciden');
        } 
                    

    }

    public function mis_turnos(Request $request){

        $schedules = Schedule::whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();
        $reservedTurns = ReservedTurn::where('dni', $request->dni)->get();

        return view('reservarTurno.misTurnos', compact('reservedTurns','schedules'));
    }

    public function destroy(ReservedTurn $reservedTurn)
    {
        $schedule = Schedule::find($reservedTurn->id_horario_atencion);

        $schedule->estado = '0';

        $schedule->save();

        $reservedTurn->delete();

        return redirect()->back()
            ->with('success', 'Turno cancelado correctamente.');
    }

    public function cancelar(ReservedTurn $reservedTurn)
    {
        $schedule = Schedule::find($reservedTurn->id_horario_atencion);

        $schedule->estado = '0';

        $schedule->save();

        $reservedTurn->delete();

        return redirect()->route('reservarTurno.especialidades')->with('success', 'Turno cancelado correctamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(PublicUser $publicUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PublicUser $publicUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PublicUser $publicUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

}
