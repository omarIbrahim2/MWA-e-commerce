<?php

namespace App\Models;

use App\Traits\GetImagePath;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory , GetImagePath;
    protected $guarded = ['id','created_at','updated_at'];

 

    public function cat(){
        return $this->belongsTo(Cat::class );
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
