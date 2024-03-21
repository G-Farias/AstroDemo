<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Models\Patient;
use App\Models\MedicalInsurence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

use App\Exports\PatientsExportsExport;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $patients = Patient::orderBy('nombre','ASC')->latest()->paginate(10);
            $q_patients = Patient::count();
        } else{
            $patients = Patient::orderBy('nombre','ASC')->where('id_especialista', Auth::user()->id_especialista)->get();
            $q_patients = Patient::where('id_especialista', Auth::user()->id_especialista)->count();
        }

        return view('pacientes.index', compact('patients','q_patients'));
    }

    public function buscar(Request $request){

        if (Gate::allows('isAdmin')) {
            $patients = Patient::where('dni', "LIKE", "%{$request->busqueda}%")
            ->orWhere('nombre', "LIKE", "%{$request->busqueda}%")
            ->orWhere('apellido', "LIKE", "%{$request->busqueda}%")
            ->orWhereRaw("concat(nombre, ' ', apellido) like '%" .$request->busqueda. "%' ")
            ->get();
        } else{

            $patients = Patient::where('id_especialista', Auth::user()->id_especialista)
            ->WhereRaw("concat(dni,' ', nombre, ' ', apellido) like  '%" .$request->busqueda. "%' ")
            ->get();        

        }

        return view('pacientes.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicalInsurence= MedicalInsurence::all();
        return view('pacientes.create', compact('medicalInsurence'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::allows('isAdmin')) {
            $patients = Patient::where('dni', $request->dni)->count();

            if($patients >= 1){
                return redirect()->route('pacientes.index')->with('danger', 'Paciente ya existente.');

            } else { 

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
            $pacientes->id_especialista = $request->user()->id_especialista;
    
            $pacientes->save();
        }
        } else {
            $patients = Patient::where('dni', $request->dni)->where('id_especialista', Auth::user()->id_especialista)->count();
      
            if($patients >= 1){
                return redirect()->route('pacientes.index')->with('danger', 'Paciente ya existente.');
            } else {

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
            $pacientes->id_especialista = $request->user()->id_especialista;
    
            $pacientes->save();
            }
        }


        

        /*
        $request->validate([
            'dni' => ['required', 'unique:patients', 'max:255'],
        ],
        [
            'dni.unique' => 'El D.N.I / Pasaporte ya se encuentra registrado.',
        ]);
*/


        
        return redirect()->route('pacientes.index')->with('success', 'Paciente agregado');
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
        
        $medicalInsurence= MedicalInsurence::all();
        return view('pacientes.edit', compact('patient','medicalInsurence'));

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
        
        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado');
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

    public function export() 
    {
        return Excel::download(new PatientsExport, 'patients.xlsx');
    }

}
