<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctorslots extends Model
{
    use HasFactory;

    protected $guarded = [];

    // this relation Is For Doctor in whic slots is for this doctor
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
