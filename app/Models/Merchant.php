<?php

namespace App\Models;
use App\Traits\HasUser;



class Merchant extends User
{
    
    use HasUser;
    protected $guarded = ['id', 'created_at','updated_at'];

    
}
