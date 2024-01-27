<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';


    public function medicalInsurence()
    {
       
        return $this->belongsTo(medicalInsurence::class, 'obra_social', 'id');
    }
}
