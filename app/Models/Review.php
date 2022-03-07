<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // This Relastion Is FOr Patient Review
    public function user()
    {
        return $this->belongsTo(User::class,'patient_id');
    }

    // This Relastion Is FOr Patient Review
    public function userdoctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }
}
