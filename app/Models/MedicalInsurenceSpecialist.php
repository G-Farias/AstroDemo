<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsurenceSpecialist extends Model
{
    protected $table = 'medical_insurence_specialists';

    public function medicalInsurence()
    {
        return $this->belongsTo(MedicalInsurence::class, 'id_obraSocial', 'id');
    }

}

