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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Specialist $specialist)
    {
        return view('especialistas.horario_atencion', compact('specialist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
          /*  echo $fecha->format("d-m-Y H:i:s") . "<br>";
            $fecha->format("d-m-Y H:i:s"); */

            $schedule = new Schedule;

            $schedule->hr_atencion = $fecha->format("H:i:s");
            $schedule->fecha_atencion = $request->date;
            $schedule->id_especialista = $request->specialist;
            $schedule->id_especialidad = $request->specialty;

            $schedule->estado = '0';

            $schedule->save();

        }

        foreach($fechas_tarde as $fecha_tarde){
            /*  echo $fecha->format("d-m-Y H:i:s") . "<br>";
              $fecha->format("d-m-Y H:i:s"); */
  
              $schedule_tarde = new Schedule;
  
              $schedule_tarde->hr_atencion = $fecha_tarde->format("H:i:s");
              $schedule_tarde->fecha_atencion = $request->date;
              $schedule_tarde->id_especialista = $request->specialist;
              $schedule_tarde->id_especialidad = $request->specialty;

              $schedule_tarde->estado = '0';
  
              $schedule_tarde->save();
  
          }

        if (Gate::allows('isAdmin')) {          
        return redirect()->route('especialistas.index')->with('success', 'Horario agregado');       
        } else {
        return redirect()->route('turno.inicio')->with('success', 'Horario agregado');       

        }   

    }

    public function destroy_horario_atencion(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()
        ->with('sucess','Horario eliminado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
