<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\ReservedTurn;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Crypt;



class PDFController extends Controller
{
    public function generatePDF()
    {
        if (Gate::allows('isAdmin')) {
            $patient = Patient::orderby('apellido','asc')->get();

        } else{
            $patient = Patient::orderby('apellido','asc')->where('id_especialista', Auth::user()->id_especialista)->get();
        }

        $data = ['title' => 'Pacientes'];
        $pdf = PDF::loadView('pdf.document',$data,compact('patient'));
        $pdf->set_paper("A4", "landscape");
        return $pdf->stream(); /* ->download('document.pdf');*/
        
    }

    public function generateTurnPDF()
    {
        if (Gate::allows('isAdmin')) {
            $turn = ReservedTurn::get();
            $schedules = Schedule::orderby('fecha_atencion','asc')->get();

        } else{
            $turn = ReservedTurn::get();
            $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','>=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();           
        }

        $data = ['title' => 'Turnos reservados'];
        $pdf = PDF::loadView('pdf.document-turno',$data,compact('turn','schedules'));
        $pdf->set_paper("A4", "landscape");
        return $pdf->stream(); /* ->download('document.pdf');*/
    }
    public function generateTurnTodayPDF()
    {
        if (Gate::allows('isAdmin')) {
            $turn = ReservedTurn::get();
            $schedules = Schedule::whereDate('fecha_atencion','=', now())->orderby('fecha_atencion','asc')->get();

        } else{
            $turn = ReservedTurn::get();
            $schedules = Schedule::where('id_especialista', Auth::user()->id_especialista)->whereDate('fecha_atencion','=', now())->orderBy('fecha_atencion','asc')->orderBy('hr_atencion','asc')->get();           
        }

        {{$DateAndTime = date('d-m-Y', time());  }}
        $data = ['title' => 'Turnos reservados del día de la fecha: '. $DateAndTime];
        $pdf = PDF::loadView('pdf.document-turno-hoy',$data,compact('turn','schedules'));
        $pdf->set_paper("A4", "landscape");


        return $pdf->stream(); /* ->download('document.pdf');*/
    }

    public function generateComprobante($RT, Request $request)
    {
        $reservedTurn = Crypt::decrypt($RT);

        $schedules = Schedule::where('id', $reservedTurn->id_horario_atencion)->get();

        $data = ['title' => 'Comprobante del turno'];
        $pdf = PDF::loadView('pdf.comprobante',$data,compact('schedules','reservedTurn'));
        $pdf->set_paper("A4", "portrait");


        return $pdf->stream();
    }
}
