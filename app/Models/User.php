<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'gender',
        'address',
        'date_of_birth',
        'medical_record',
        'type',
        'cat_id',
        'social_id',
        'image',
        'url',
        'description',
        'hospital_name',
        'fees',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // this relastion is for belongs to category for doctor
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }

    // this relation is for doctor review in whic is review is for whic doctor
    // public function review()
    // {
    //     return $this->hasMany(Review::class,'doctor_id');
    // }

    // public function reviewpatient()
    // {
    //     return $this->hasMany(Review::class,'patient_id');
    // }

    // This Relastion Is For Doctor speciality How Many speciality is in doctor  
    public function speciality()
    {
        return $this->hasMany(Speciality::class);
    }


    
}
