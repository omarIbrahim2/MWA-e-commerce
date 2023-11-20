<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];


    
    
    public function items(){
        return $this->hasMany(Item::class);
    }
}
