<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Models\Patient;
use App\Models\Archivo;
use App\Models\MedicalInsurence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

use App\Exports\PatientsExportsExport;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $patients = Patient::orderBy('nombre','ASC')->paginate(10);
            $q_patients = Patient::count();
        } else{
            $patients = Patient::orderBy('nombre','ASC')->where('id_especialista', Auth::user()->id_especialista)->paginate(10);
            $q_patients = Patient::where('id_especialista', Auth::user()->id_especialista)->count();
        }


        return view('pacientes.index', compact('patients','q_patients'));
    }   

    public function pendiente(){
        
        $prePatients = User::where('patient','0')->paginate(10);
        $q_patients = User::where('patient','0')->count();

        return view('pacientes.pendientes', compact('prePatients','q_patients'));
    }

    public function pendiente_save($prepatient){
        $medicalInsurence= MedicalInsurence::all();
        $prePatient = User::where('user', $prepatient)->get();

        return view('pacientes.pendiente_save', compact('medicalInsurence', 'prePatient'));
    }
    
    public function buscar(Request $request){

        if (Gate::allows('isAdmin')) {
            $q_patients = Patient::count();
            $patients = Patient::where('dni', "LIKE", "%{$request->busqueda}%")
            ->orWhere('nombre', "LIKE", "%{$request->busqueda}%")
            ->orWhere('apellido', "LIKE", "%{$request->busqueda}%")
            ->orWhereRaw("concat(nombre, ' ', apellido) like '%" .$request->busqueda. "%' ")
            ->paginate(10)->withQueryString();

            return view ('pacientes.index', compact('patients','q_patients'));
        } else{
            $q_patients = Patient::where('id_especialista', Auth::user()->id_especialista)->count();

            $patients = Patient::where('id_especialista', Auth::user()->id_especialista)
            ->WhereRaw("concat(dni,' ', nombre, ' ', apellido) like  '%" .$request->busqueda. "%' ")
            ->paginate(10)->withQueryString();       

        }

        return view('pacientes.index', compact('patients','q_patients'));
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
    public function store(Request $request, User $user)
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

                $user = User::where('user', $request->dni)->first();         
                
                if($user){
                $user->patient = '1';
                $user->save();
                }else {
                    return redirect()->route('pacientes.index')->with('success', 'paciente almacenado correctamente');

                }

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

             $user = User::where('user', $request->dni)->first();         
        
                if($user){
                $user->patient = '1';
                $user->save();
                }else {
                    return redirect()->route('pacientes.index')->with('success', 'paciente almacenado correctamente');

                }
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

    public function archivo(Request $request, Patient $patient)
    {

        $orden = $request->get('orden', 'desc'); // default = más nuevos primero


        $archivos = Archivo::orderBy('created_at', $orden)->where('id_paciente', $patient->id)->paginate(50);

        return view('pacientes.archivos', compact('archivos','patient','orden'));
    
    }


    public function archivo_store(Request $request, Patient $patient)
    {
    $request->validate([
        'archivo' => 'required|file|max:2048'
    ]);

    if ($request->hasFile('archivo')) {
        $nombre = time().'_'.$request->file('archivo')->getClientOriginalName();

        $ruta = $request->file('archivo')->store('archivos');

     

        archivo::create([
            'nombre' => $nombre,
            'id_paciente' => $patient->id,
            'id_especialista'=>  $request->user()->id_especialista,
            'ruta' => $ruta
        ]);
    }

    return back()->with('success', 'Archivo subido correctamente.');
    }
/*
    public function obtener_archivo(Request $request, Patient $patient){
        $archivo = Archivo::where('id_paciente', $patient);

        return view('pacientes.archivos', compact('archivo'));
    }


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
    $request->validate([
        'dni' => [
            'required',
            'max:255',
            Rule::unique('patients')->ignore($id),
        ],
        'email' => [
            'max:255',
            Rule::unique('patients')->ignore($id),
        ],
    ],
    [
        'dni.unique' => 'El D.N.I / Pasaporte ya se encuentra registrado.',
        'email.unique' => 'El Email ya se encuentra registrado.',
    ]);   

        $pacientes = patient::find($id);

        $oldDni = $pacientes->dni;


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
        
        $user = User::where('user', $oldDni)->first();

        if ($user) {
            $user->user = $request->dni;
            $user->name = $request->nombre;
            $user->surname = $request->apellido;
            $user->email = $request->email;

            $user->save();
        } else {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {

        if($user = User::where('user', $patient->dni)->first()){
            $user->patient = '0';
            $user->save();
        }else {
            //
        }
            $patient->delete();

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente eliminado correctamente.');
    }

    public function export() 
    {
        return Excel::download(new PatientsExport, 'patients.xlsx');
    }



}
