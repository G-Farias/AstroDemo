<?php

namespace App\Http\Controllers;

use App\Models\MedicalInsurence;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\Patient;
use App\Models\ReservedTurn;
use App\Models\Specialist;
use App\Models\Specialty;
use App\Models\Schedule;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\DB;
use function Ramsey\Uuid\v1;

class ReservedTurnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(Request $request){

        if (Gate::allows('isAdmin')) {
            $specialists = Specialist::all();
            $medicalInsurence = MedicalInsurence::all();
            $reservedTurns = ReservedTurn::get();
            $schedules = Schedule::whereDate('fecha_atencion','=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();
            }else{
            $specialists = Specialist::all();
            $medicalInsurence = MedicalInsurence::all();
            $reservedTurns = ReservedTurn::get();
            $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();           
    
            }
    
        return view('dashboard', compact('specialists','reservedTurns','medicalInsurence','schedules'));
    }

    public function index(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $reservedTurn = ReservedTurn::latest()->paginate(10);
            $specialtys = Specialty::all();
            $schedules = Schedule::where('id_especialidad', $request->especialidad)->where('fecha_atencion', $request->date)->whereDate('fecha_atencion','>=', now())->get();
        } else{
            $reservedTurn = ReservedTurn::latest()->paginate(10);
            $specialtys = Specialty::all();
            $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->where('fecha_atencion', $request->date)->whereDate('fecha_atencion','>=', now())->get();
        }
        return view('turno.index', compact('reservedTurn','specialtys', 'schedules'));
    }

    public function busqueda_especialidad(Request $request){

        if (Gate::allows('isAdmin')) {
            $reservedTurn = ReservedTurn::latest()->paginate(10);
            $specialtys = Specialty::all();
            $schedules = Schedule::where('id_especialidad', $request->especialidad)->whereDate('fecha_atencion','>=', now())->orderby('id_especialista','asc')->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();

        }else{
            $reservedTurn = ReservedTurn::latest()->paginate(10);
            $specialtys = Specialty::all();
            $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();

        }
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

        //Agregar paciente al reservar turno
        if (Patient::where('dni', $request->dni)->first()) {
            // It exists
        } else {
            $patient = new Patient;

            $patient->nombre = $request->nombre;
            $patient->apellido = $request->apellido;
            $patient->dni = $request->dni;
            $patient->celular = $request->celular;
            $patient->email = $request->email;
            $patient->obra_social = $request->obra_social;
            $patient->numero_obraSocial = $request->numero_obraSocial;
            $patient->id_especialista = $request->user()->id_especialista;
   
            $patient->save();

        }
        //-----------------
        
        return redirect()->route('turno.inicio')->with('success', 'Turno reservado');

        } else {
            return back()->with('danger', 'D.N.I / Pasaporte no coinciden');
        }
                

    }
    public function turnos_reservados(Request $request) {
        
        if (Gate::allows('isAdmin')) {
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $reservedTurns = ReservedTurn::get();
        $schedules = Schedule::whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','desc')->orderBy('hr_atencion','desc')->take(100)->get();
        }else{
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $reservedTurns = ReservedTurn::get();
        $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->take(100)->get();           

        }
        return view('turno.reservados', compact('specialists','reservedTurns','medicalInsurence','schedules'));

    }

    public function turnos_reservados_fecha(Request $request){

        if (Gate::allows('isAdmin')) {
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $schedules = Schedule::where('id_especialista', $request->especialista)->where('fecha_atencion', $request->fecha_busqueda)->whereDate('fecha_atencion','>=', now())->orderBy('hr_atencion','asc')->get();
        $reservedTurns = ReservedTurn::get();
        }else{
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->where('fecha_atencion', $request->fecha_busqueda)->whereDate('fecha_atencion','>=', now())->orderBy('hr_atencion','asc')->get();
        $reservedTurns = ReservedTurn::get();           
        }
        return view('turno.reservados', compact('specialists','schedules','reservedTurns','medicalInsurence'));
    }

    public function turnos_reservados_especialidad(Request $request){
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $schedules = Schedule::where('id_especialista', $request->especialista)->whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->take(130)->get();
        $reservedTurns = ReservedTurn::get();

        return view('turno.reservados', compact('specialists','schedules','reservedTurns','medicalInsurence'));
    }

    public function turnos_reservados_dni(Request $request){
        $specialists = Specialist::all();
        $medicalInsurence = MedicalInsurence::all();
        $schedules = Schedule::whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->take(130)->get();
        $reservedTurns = ReservedTurn::where('dni', $request->dni)->get();

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
        $schedule = Schedule::find($reservedTurn->id_horario_atencion);

        $schedule->estado = '0';

        $schedule->save();

        $reservedTurn->delete();

        return redirect()->back()
            ->with('success', 'Turno cancelado correctamente.');
    }

}
