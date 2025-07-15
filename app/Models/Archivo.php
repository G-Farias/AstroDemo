<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';

    protected $fillable = [
        'nombre',
        'ruta',
        'id_paciente',
        'id_especialista',
    ];

    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }
}
