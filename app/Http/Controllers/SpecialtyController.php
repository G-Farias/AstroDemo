<?php

namespace App\Http\Controllers;

use App\Models\MedicalInsurenceSpecialist;
use App\Models\ReservedTurn;
use App\Models\Specialist;
use App\Models\Specialty;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialtys = Specialty::orderBy('nombre_especialidad','ASC')->latest()->paginate(10);

        return view('especialidad.index', compact('specialtys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('especialidad.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_especialidad' => ['required', 'unique:specialties', 'max:255'],
        ],
        [
            'nombre_especialidad.unique' => 'El nombre de la especialidad ya se encuentra registrada.',
        ]);

        $specialty = new Specialty;

        $specialty->nombre_especialidad = $request->nombre_especialidad;
        $specialty->sobreturno = $request->sobreturno;
    
        
        $specialty->save();

        return redirect()->route('especialidad.index')->with('success', 'Especialidad agregada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        return view('especialidad.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $specialty = specialty::find($id);

        $specialty->nombre_especialidad = $request->nombre_especialidad;
        $specialty->sobreturno = $request->sobreturno;
    
        
        $specialty->save();

        return redirect()->route('especialidad.index')->with('success', 'Especialidad actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
     
    $specialist =  Specialist::where('especialidad', $specialty->id)->get()->toArray();

    MedicalInsurenceSpecialist::where('id_especialista', $specialist)->delete();

    User::where('id_especialista', $specialist)->delete();

    Specialist::where('especialidad', $specialty->id)->delete(); 

    Patient::where('id_especialista', $specialist)->delete(); 
        
    Schedule::where('id_especialidad', $specialty->id)->delete(); 
   
    $specialty->delete(); 

        return redirect()->route('especialidad.index')
        ->with('sucess', 'Especialidad eliminada');
    }
}
