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
        $intervalo = $request->intervalo;
        
        $inicio = new DateTime($inicio_turno_mañana);
        $fin = new DateTime($fin_turno_mañana);

        $intervalo = new DateInterval('PT'.$intervalo.'M');

        $fechas = new DatePeriod($inicio, $intervalo, $fin);

        foreach($fechas as $fecha){
          /*  echo $fecha->format("d-m-Y H:i:s") . "<br>";
            $fecha->format("d-m-Y H:i:s"); */

            $schedule = new Schedule;

            $schedule->hr_atencion = $fecha->format("H:i:s");
            $schedule->fecha_atencion = $request->date;
            $schedule->id_especialista = $request->specialist;
            $schedule->estado = '0';

            $schedule->save();

        }

        return redirect()->route('especialistas.index')->with('mensaje', 'Horario agregado');          

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
