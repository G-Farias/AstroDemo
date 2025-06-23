<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
    'hr_atencion',
    'fecha_atencion',
    'id_especialista',
    'id_especialidad',
    'estado',
];

    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'id_especialista', 'id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'id_especialidad', 'id');
    }


    public function ReservedTurn(){
        return $this->hasMany(ReservedTurn::class);
       }
}

