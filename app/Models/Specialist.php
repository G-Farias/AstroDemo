<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    protected $table = 'specialists';

    public function Specialty()
    {
        return $this->belongsTo(Specialty::class, 'especialidad', 'id');
    }

}
