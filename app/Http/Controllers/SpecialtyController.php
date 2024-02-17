<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialtys = Specialty::latest()->paginate(10);

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
        $specialty->delete();

        return redirect()->route('especialidad.index')
        ->with('sucess', 'Especialidad eliminada');
    }
}
