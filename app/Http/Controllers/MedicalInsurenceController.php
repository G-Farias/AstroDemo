<?php

namespace App\Http\Controllers;

use App\Models\MedicalInsurence;
use Illuminate\Http\Request;

class MedicalInsurenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalInsurences = MedicalInsurence::latest()->paginate(10);

        return view('obraSocial.index', compact('medicalInsurences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obraSocial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $medicalInsurence = new MedicalInsurence;

        $medicalInsurence->nombre_obraSocial = $request->nombre_obraSocial;
        $medicalInsurence->precio_obraSocial = $request->precio_obraSocial;
        $medicalInsurence->info_obraSocial = $request-> info_obraSocial;

        $medicalInsurence->save();

        return redirect()->route('obraSocial.index')->with('mensaje', 'Obra Social / Prepaga agregada');

    }

    /**
     * Display the specified resource.
     */
    public function show(MedicalInsurence $medicalInsurence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalInsurence $medicalInsurence)
    {
        return view('obraSocial.edit', compact('medicalInsurence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medicalInsurence = medicalInsurence::find($id);

        $medicalInsurence->nombre_obraSocial = $request->nombre_obraSocial;
        $medicalInsurence->precio_obraSocial = $request->precio_obraSocial;
        $medicalInsurence->info_obraSocial = $request-> info_obraSocial;

        $medicalInsurence->save();

        return redirect()->route('obraSocial.index')->with('mensaje', 'Obra Social / Prepaga actualizadas');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalInsurence $medicalInsurence)
    {
        $medicalInsurence->delete();

        return redirect()->route('obraSocial.index')
            ->with('success', 'Obra Social / Prepaga eliminada correctamente.');
    }
}
