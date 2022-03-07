<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relastion With Subcategory || Subcategory Record With Show Category
    public function subcategory()
    {
        return $this->hasMany(Subcategory::class);
    }
    
    
    // Relastion With User AND Doctor || Doctor Record With Show Category
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
