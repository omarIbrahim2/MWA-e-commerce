<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];

    public function item(){
        return $this->belongsTo(Item::class);
    }

    public function productImgs(){
        return $this->hasMany(ProductImg::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
