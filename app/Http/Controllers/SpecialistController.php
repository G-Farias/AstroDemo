<?php

namespace App\Http\Controllers;

use App\Models\MedicalInsurence;
use App\Models\MedicalInsurenceSpecialist;
use App\Models\Schedule;
use App\Models\Specialist;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\ExcludeIf;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $specialists = Specialist::orderBy('nombre','ASC')->latest()->paginate(10);
            $q_specialist = Specialist::count();
            $limit_q_specialist = SistConfigController::q_especialistas;
        } else{
            $specialists = Specialist::orderBy('nombre','ASC')->where('id', Auth::user()->id_especialista)->get();
            $q_specialist = Specialist::count();
            $limit_q_specialist = SistConfigController::q_especialistas;

        }

        return view('especialistas.index', compact('specialists','q_specialist','limit_q_specialist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialty = Specialty::all();
        return view('especialistas.create', compact('specialty'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $q_specialist = Specialist::count();

        
        if($q_specialist < SistConfigController::q_especialistas){

        
        $request->validate([
            'dni' => ['required', 'unique:specialists', 'max:255'],
            'email' => ['required', 'unique:specialists', 'max:255'],
        ],
        [
            'dni.unique' => 'El D.N.I / Pasaporte ya se encuentra registrado.',
            'email.unique' => 'El Email ya se encuentra registrado.'
        ]);

        $specialist = new Specialist;
 
        $specialist->nombre = $request->nombre;
        $specialist->apellido = $request->apellido;
        $specialist->dni = $request->dni;
        $specialist->celular = $request->celular;
        $specialist->telefono = $request->telefono;
        $specialist->telefono = $request->telefono;
        $specialist->email = $request->email;
        $specialist->password = $request->password;
        $specialist->especialidad = $request->especialidad;
        $specialist->matricula = $request->matricula;
        $specialist->dia_atencion = $request->dia_atencion;
        $specialist->hr_atencion = $request->hr_atencion;
        $specialist->provincia_residencia = $request->provincia_residencia;
        $specialist->localidad_residencia = $request->localidad_residencia;

        $specialist->save();

        $user = new User;

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->level = '1';
        $user->id_especialista = $specialist->id;

        $user->save();
    
    } else {
        return redirect()->route('especialistas.index')->with('danger', '¡Alcanzaste el limite de registro de especialistas!');
    }

        
        return redirect()->route('especialistas.index')->with('success', 'Especialista agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialist $specialist)
    {
        $medicalInsurenceSpecialists = MedicalInsurenceSpecialist::where('id_especialista', $specialist->id)->get();

        return view('especialistas.show', compact('specialist','medicalInsurenceSpecialists'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialist $specialist)
    {
        $specialty = Specialty::all();

        return view('especialistas.edit', compact('specialist','specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $specialist = Specialist::find($id);

        
        $specialist->nombre = $request->nombre;
        $specialist->apellido = $request->apellido;
        $specialist->dni = $request->dni;
        $specialist->celular = $request->celular;
        $specialist->telefono = $request->telefono;
        $specialist->telefono = $request->telefono;
        $specialist->email = $request->email;
        $specialist->password = $request->password;
        $specialist->especialidad = $request->especialidad;
        $specialist->matricula = $request->matricula;
        $specialist->dia_atencion = $request->dia_atencion;
        $specialist->hr_atencion = $request->hr_atencion;
        $specialist->provincia_residencia = $request->provincia_residencia;
        $specialist->localidad_residencia = $request->localidad_residencia;

        $specialist->save();

        $user = User::where('id_especialista', $id)->first();

        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        
        return redirect()->route('especialistas.index')->with('success', 'Especialista actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist)
    {
        User::where('id_especialista', $specialist->id)->delete(); 

        MedicalInsurenceSpecialist::where('id_especialista', $specialist->id)->delete();


        $specialist->delete();

        return redirect()->route('especialistas.index')
        ->with('sucess','Especialista eliminado correctamente');
    }

    public function obras_sociales(Specialist $specialist)
    {
     
        
        $medicalInsurence = MedicalInsurence::orderBy('nombre_obraSocial','ASC')->get();
       // $medicalInsurenceSpecialist = MedicalInsurenceSpecialist::all();
        $medicalInsurenceSpecialists = MedicalInsurenceSpecialist::where('id_especialista', $specialist->id)->get();


        return view('especialistas.obras_sociales', compact('medicalInsurence', 'specialist', 'medicalInsurenceSpecialists'));

    }

    public function store_obras_sociales(Request $request, $id)
    {
        $request->validate([
            'id_obraSocial' => [
                'required',
                Rule::unique('medical_insurence_specialists')->where('id_especialista', request($id))
            ],
          'id_especialista' => [
                    'required',
                    Rule::unique('medical_insurence_specialists')->where('id_obraSocial', request('id_obraSocial'))
                ],
        ]); 

        $medicalInsurenceSpecialist = new MedicalInsurenceSpecialist();
 
        $medicalInsurenceSpecialist->id_obraSocial = $request-> id_obraSocial;
        $medicalInsurenceSpecialist->id_especialista = $request->id_especialista;

        $medicalInsurenceSpecialist->save();

      return back()->with('success', 'Obra social / prepaga agregadas');   
        
    }

    public function destroy_obras_sociales(MedicalInsurenceSpecialist $medicalInsurenceSpecialist)
    {
        $medicalInsurenceSpecialist->delete();

        return redirect()->back()
        ->with('sucess','Obra social / prepaga eliminada correctamente');
    }

    public function horario_atencion(Request $request, Specialist $specialist){
        


        $schedule = Schedule::where('id_especialista', $specialist->id)->where('fecha_atencion', $request->fecha_busqueda)->get();


        return view('especialistas.horario_atencion', compact('specialist', 'schedule'));
    }
}
