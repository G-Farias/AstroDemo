<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedTurn extends Model
{
    protected $table = 'reserved_turns';

    public function medicalInsurence()
    {
        return $this->belongsTo(MedicalInsurence::class, 'obra_social', 'id');
    }

 
    public function Schedule(){
        return $this->belongsTo(Schedule::class, 'id_horario_atencion', 'id');
       }
}
