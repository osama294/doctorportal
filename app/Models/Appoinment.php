<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appoinment extends Model
{
    use HasFactory;
    protected $guarded = [];

    // protected $appends = ['patient_id'];

    // this Reltion is For This appoinment Show In which Patient Book this appoinment
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    // this Reltion is For This appoinment Show In which Doctor Book this appoinment
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id')->with('category');
    }

    // this Reltion is For This appoinment Showing Doctor Slots
    public function slot()
    {
        return $this->belongsTo(Doctorslots::class, 'slot_id');
    }

    // this Reltion is For This How Many Symptoms IN this APpoinment Of Patient
    public function patientsymptom()
    {
        return $this->hasMany(PatientSymptom::class);
    }


    // public function getPatientIdAttribute() {
    //     return $khan = Appoinment::select('id')->get();
    // }


}
