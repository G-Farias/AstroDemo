<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::latest()->paginate(10);

        return view('pacientes.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pacientes = new Patient;

        $pacientes->nombre = $request->nombre;
        $pacientes->apellido = $request->apellido;
        $pacientes->dni = $request->dni;
        $pacientes->fecha_nacimiento = $request->fecha_nacimiento;
        $pacientes->celular = $request->celular;
        $pacientes->telefono = $request->telefono;
        $pacientes->email = $request->email;
        $pacientes->obra_social = $request->obra_social;
        $pacientes->numero_obraSocial = $request->numero_obraSocial;
        $pacientes->observacion = $request->observacion;
        $pacientes->direccion = $request->direccion;
        $pacientes->pais_residencia = $request->pais;
        $pacientes->localidad_residencia = $request->localidad_residencia;
        $pacientes->provincia_residencia = $request->provincia_residencia;

        $pacientes->save();
        
        return redirect()->route('pacientes.index')->with('mensaje', 'Paciente agregadao');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return view('pacientes.show', compact('patient'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('pacientes.edit', compact('patient'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pacientes = patient::find($id);


        $pacientes->nombre = $request->nombre;
        $pacientes->apellido = $request->apellido;
        $pacientes->dni = $request->dni;
        $pacientes->fecha_nacimiento = $request->fecha_nacimiento;
        $pacientes->celular = $request->celular;
        $pacientes->telefono = $request->telefono;
        $pacientes->email = $request->email;
        $pacientes->obra_social = $request->obra_social;
        $pacientes->numero_obraSocial = $request->numero_obraSocial;
        $pacientes->observacion = $request->observacion;
        $pacientes->direccion = $request->direccion;
        $pacientes->pais_residencia = $request->pais;
        $pacientes->localidad_residencia = $request->localidad_residencia;
        $pacientes->provincia_residencia = $request->provincia_residencia;

        $pacientes->save();
        
        return redirect()->route('pacientes.index')->with('mensaje', 'Paciente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente eliminado correctamente.');
    }
}
