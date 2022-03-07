<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    use HasFactory;

    // This Relastion Is For Patient  WHich Show All illness Of patient
    public function patientillness()
    {
        return $this->hasMany(PatientIllnes::class);
    }
}
