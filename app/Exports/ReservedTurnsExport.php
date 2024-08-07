<?php

namespace App\Exports;

use App\Models\ReservedTurn;
use App\Models\Schedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;


class ReservedTurnsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (Gate::allows('isAdmin')) {
            return view('export.reservedTurn', [

            'reservedTurns' => ReservedTurn::join('schedules', 'schedules.id', "=", "reserved_turns.id_horario_atencion")
            ->orderby('schedules.fecha_atencion','ASC')->orderby('schedules.hr_atencion','ASC')
            ->get()
            
            ]);
        } else{
            return view('export.reservedTurn', [
                'reservedTurns' => ReservedTurn::join('schedules', 'schedules.id', "=", "reserved_turns.id_horario_atencion")
                ->where('id_especialista', Auth::user()->id_especialista)
                ->orderby('schedules.fecha_atencion','ASC')->orderby('schedules.hr_atencion','ASC')
                ->get()
            ]);
        }
    }


}
