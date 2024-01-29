<?php

namespace App\Http\Controllers;

use App\Models\Specialist;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialists = Specialist::latest()->paginate(10);

        return view('especialistas.index', compact('specialists'));
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
        
        return redirect()->route('especialistas.index')->with('mensaje', 'Especialista agregado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialist $specialist)
    {
        return view('especialistas.show', compact('specialist'));

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
        
        return redirect()->route('especialistas.index')->with('mensaje', 'Especialista actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialist $specialist)
    {
        $specialist->delete();

        return redirect()->route('especialistas.index')
        ->with('sucess','Especialista eliminado correctamente');
    }
}
