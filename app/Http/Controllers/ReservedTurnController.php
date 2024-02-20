<?php

namespace App\Http\Controllers;

use App\Models\MedicalInsurence;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\ReservedTurn;
use App\Models\Specialist;
use App\Models\Specialty;
use App\Models\Schedule;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ReservedTurnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reservedTurn = ReservedTurn::latest()->paginate(10);
        $specialtys = Specialty::all();
        $schedules = Schedule::where('id_especialidad', $request->especialidad)->where('fecha_atencion', $request->date)->get();


        return view('turno.index', compact('reservedTurn','specialtys', 'schedules'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Schedule $schedule)
    {
        $medicalInsurence = MedicalInsurence::all();

        $medicalInsurenceSpecialist = MedicalInsurenceSpecialist::where('id_especialista', $schedule->id_especialista)->get();

        return view('turno.create', compact('schedule', 'medicalInsurence','medicalInsurenceSpecialist'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->dni == $request->dni_rep) {
  

        $reservedTurn = new ReservedTurn;

        $reservedTurn->nombre = $request->nombre;
        $reservedTurn->apellido = $request->apellido;
        $reservedTurn->dni = $request->dni;
        $reservedTurn->celular = $request->celular;
        $reservedTurn->email = $request->email;
        $reservedTurn->obra_social = $request->obra_social;
        $reservedTurn->numero_obraSocial = $request->numero_obraSocial;
        $reservedTurn->id_horario_atencion = $request-> id_horario;
        $reservedTurn->observacion = $request->observacion;
        $reservedTurn->estado = '1';

        $reservedTurn->save();

        $schedule = Schedule::find($request->id_horario);
        $schedule->estado = '1';

        $schedule->save();

        return redirect()->route('turno.inicio')->with('success', 'Turno reservado');

        } else {
            return back()->with('danger', 'D.N.I / Pasaporte no coinciden');
        }
                

    }
    public function turnos_reservados(Request $request) {
        
        $specialists = Specialist::all();

        $medicalInsurence = MedicalInsurence::all();

        $schedules = Schedule::where('id_especialista', $request->especialista)->where('fecha_atencion', $request->fecha_busqueda)->get();

        $reservedTurns = ReservedTurn::all();

        return view('turno.reservados', compact('specialists','schedules','reservedTurns','medicalInsurence'));

    }
    public function turnos_reservados_update(ReservedTurn $reservedTurn, Request $request, $id){

        $reservedTurn = ReservedTurn::find($id);

        $reservedTurn->estado = $request->estado;
        $reservedTurn->observacion = $request->observacion;

        $reservedTurn->save();

        return redirect()->back();

    }
    public function turnos_reservados_update_ob(ReservedTurn $reservedTurn, Request $request, $id){

        $reservedTurn = ReservedTurn::find($id);

        $reservedTurn->observacion = $request->observacion;

        $reservedTurn->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(ReservedTurn $reservedTurn)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReservedTurn $reservedTurn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReservedTurn $reservedTurn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservedTurn $reservedTurn)
    {
        //
    }
}
