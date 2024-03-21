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
                'turn' => ReservedTurn::all(),
                'schedules' => Schedule::all()
            ]);
    
        } else{
            return view('export.reservedTurn', [
                'turn' => ReservedTurn::all(),
                'schedules' => Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','>=', now())->get()  
            ]);
        }
    }


}
