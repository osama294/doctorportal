<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientIllnes extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = ['patient_id','illness_id'];

    // This Relastion Is For Patient  WHich Show All illness Of patient
    public function illness()
    {
        return $this->belongsTo(Illness::class,'illness_id');
    }
}
