<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PatientsExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (Gate::allows('isAdmin')) {
            return view('export.patients', [
                'patients' => Patient::get()
            ]);
        } else{
            return view('export.patients', [
                'patients' => Patient::where('id_especialista', Auth::user()->id_especialista)->get()
            ]);
        }




    }
}
