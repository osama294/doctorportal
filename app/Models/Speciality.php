<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $guarded = [];


    // Belongs Relastion With Subcategory 
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class,'subcat_id');
    }


    // Belong Relastion With User For Doctor This Speciality is for which doctor
    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }


    
}
