<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;



class Subcategory extends Model
{

    use HasFactory;
    protected $appends = ['totaldoctors'];

    protected $guarded = [];


    // Belongs TO Catgory FOr Sub CATEGORY
    public function category()
    {
        return $this->belongsTo(Category::class,'cat_id');
    }

    // When i check The SUbcategory Record SHow count Of Doctor Of This Sub category
    public function getTotaldoctorsAttribute() {
        return Speciality::where('subcat_id',$this->id)->count();
    }

    // Subcategory Add In Speciality Table With Doctro This Subcategory is Speciality Of Doctor 
    // this Relastion Is for Doctor 
    public function speciality()
    {
        return $this->hasMany(Speciality::class);
    }
}
