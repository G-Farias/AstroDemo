<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInsurence extends Model
{
    protected $table = 'medical_insurences';

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function medicalInsurenceSpecialist()
    {
        return $this->hasMany(medicalInsurenceSpecialist::class);
    }
    
}
