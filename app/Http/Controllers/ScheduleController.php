<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ScheduleController extends Controller
{

    public function create(Specialist $specialist)
    {
        return view('especialistas.horario_atencion', compact('specialist'));
    }

    /**
     * Store a newly created resource in storage.
     */
 /*   public function store(Request $request)
    {
    
        

        $inicio_turno_mañana = $request->inicio_turno_mañana;
        $fin_turno_mañana = $request->fin_turno_mañana;
        $inicio_turno_tarde = $request->inicio_turno_tarde;
        $fin_turno_tarde = $request->fin_turno_tarde;

        $intervalo = $request->intervalo;

        $inicio_tarde = new DateTime($inicio_turno_tarde);
        $fin_tarde = new DateTime($fin_turno_tarde);

        
        $inicio = new DateTime($inicio_turno_mañana);
        $fin = new DateTime($fin_turno_mañana);

        $intervalo = new DateInterval('PT'.$intervalo.'M');

        $fechas = new DatePeriod($inicio, $intervalo, $fin);
        $fechas_tarde = new DatePeriod($inicio_tarde, $intervalo, $fin_tarde);


        foreach($fechas as $fecha){

            $horario = Schedule::where('hr_atencion', $fecha->format("H:i:s"))
            ->where('fecha_atencion', $request->date)
            ->where('id_especialista', $request->specialist)->count();

            if($horario == '1'){
                return redirect()->back()->with('danger', 'Ya hay registro de horario para ese día, si quiere agregar más, agregue los faltantes o elimine los anteriores!');   
            } else {
               
                $schedule = new Schedule;

                $schedule->hr_atencion = $fecha->format("H:i:s");
                $schedule->fecha_atencion = $request->date;
                $schedule->id_especialista = $request->specialist;
                $schedule->id_especialidad = $request->specialty;
    
                $schedule->estado = '0';
    
                $schedule->save();
            }
            
        }

        foreach($fechas_tarde as $fecha_tarde){

            $horario = Schedule::where('hr_atencion', $fecha_tarde->format("H:i:s"))
            ->where('fecha_atencion', $request->date)
            ->where('id_especialista', $request->specialist)->count();

            if($horario == '1'){
                return redirect()->back()->with('danger', 'Ya hay registro de horario para ese día, si quieres agregar más elimina los anteriores!');   
            } else {

              $schedule_tarde = new Schedule;
  
              $schedule_tarde->hr_atencion = $fecha_tarde->format("H:i:s");
              $schedule_tarde->fecha_atencion = $request->date;
              $schedule_tarde->id_especialista = $request->specialist;
              $schedule_tarde->id_especialidad = $request->specialty;

              $schedule_tarde->estado = '0';
  
              $schedule_tarde->save();
            }
          }

        if (Gate::allows('isAdmin')) {          
        return redirect()->back()->with('success', 'Horario agregado');       
        } else {
        return redirect()->back()->with('success', 'Horario agregado');       
            
        }    
       
    } 

*/
/*
public function store(Request $request)
{
    $intervaloMin = (int) $request->intervalo;

    // Crear los rangos
    $rangoMañana = $this->generarPeriodos($request->inicio_turno_mañana, $request->fin_turno_mañana, $intervaloMin);
    $rangoTarde = $this->generarPeriodos($request->inicio_turno_tarde, $request->fin_turno_tarde, $intervaloMin);

    // Insertar horarios de ambos rangos
    $duplicados = 0;
    foreach ([$rangoMañana, $rangoTarde] as $periodo) {
        foreach ($periodo as $hora) {
            if ($this->existeHorario($hora, $request)) {
                $duplicados++;
                continue;
            }

            Schedule::create([
                'hr_atencion'     => $hora->format("H:i:s"),
                'fecha_atencion'  => $request->date,
                'id_especialista' => $request->specialist,
                'id_especialidad' => $request->specialty,
                'estado'          => '0',
            ]);
        }
    }

    if ($duplicados > 0) {
        return redirect()->back()->with('danger', 'Algunos horarios ya estaban registrados. Se omitieron ' . $duplicados . ' duplicados.');
    }

    return redirect()->back()->with('success', 'Horario agregado correctamente.');
}

    private function generarPeriodos($inicio, $fin, $intervaloMin)
    {
        $inicio = new DateTime($inicio);
        $fin = new DateTime($fin);
        $intervalo = new DateInterval('PT' . $intervaloMin . 'M');

        return new DatePeriod($inicio, $intervalo, $fin);
    }

    private function existeHorario($hora, $request)
    {
        return Schedule::where('hr_atencion', $hora->format("H:i:s"))
            ->where('fecha_atencion', $request->date)
            ->where('id_especialista', $request->specialist)
            ->exists();
    }
*/
public function store(Request $request)
{
    $desde = Carbon::parse($request->desde);
    $hasta = Carbon::parse($request->hasta);
    $diasSeleccionados = $request->dias ?? [];

    $intervaloDias = new \DateInterval('P1D');
    $periodoFechas = new \DatePeriod($desde, $intervaloDias, $hasta->copy()->addDay());

    $minutos = (int) $request->intervalo;

    foreach ($periodoFechas as $fecha) {
        $fechaCarbon = Carbon::instance($fecha);

        if (!in_array($fechaCarbon->dayOfWeek, $diasSeleccionados)) continue;

        // Mañana
        if ($request->inicio_turno_mañana && $request->fin_turno_mañana) {
            $inicioM = Carbon::createFromFormat('Y-m-d H:i', $fechaCarbon->format('Y-m-d') . ' ' . $request->inicio_turno_mañana);
            $finM = Carbon::createFromFormat('Y-m-d H:i', $fechaCarbon->format('Y-m-d') . ' ' . $request->fin_turno_mañana);

            while ($inicioM < $finM) {
                Schedule::updateOrCreate([
                    'hr_atencion'     => $inicioM->format('H:i:s'),
                    'fecha_atencion'  => $fechaCarbon->format('Y-m-d'),
                    'id_especialista' => $request->specialist,
                ], [
                    'id_especialidad' => $request->specialty,
                    'estado'          => '0',
                ]);

                $inicioM->addMinutes($minutos);
            }
        }

        // Tarde
        if ($request->inicio_turno_tarde && $request->fin_turno_tarde) {
            $inicioT = Carbon::createFromFormat('Y-m-d H:i', $fechaCarbon->format('Y-m-d') . ' ' . $request->inicio_turno_tarde);
            $finT = Carbon::createFromFormat('Y-m-d H:i', $fechaCarbon->format('Y-m-d') . ' ' . $request->fin_turno_tarde);

            while ($inicioT < $finT) {
                Schedule::updateOrCreate([
                    'hr_atencion'     => $inicioT->format('H:i:s'),
                    'fecha_atencion'  => $fechaCarbon->format('Y-m-d'),
                    'id_especialista' => $request->specialist,
                ], [
                    'id_especialidad' => $request->specialty,
                    'estado'          => '0',
                ]);

                $inicioT->addMinutes($minutos);
            }
        }
    }

    return redirect()->back()->with('success', 'Horarios registrados correctamente.');
}


    public function destroy_horario_atencion(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()
        ->with('sucess','Horario eliminado correctamente');

    }

    public function destroy_horario_all_atencion(Request $request, Specialist $specialist){

     $schedules =  Schedule::where('id_especialista', $specialist->id)->where('fecha_atencion', $request->fecha_busqueda)->get();

     foreach ($schedules as $schedule) {
        $schedule->delete();
     }
        return redirect()->back()
        ->with('sucess','Horario eliminado correctamente'); 
    }

}
