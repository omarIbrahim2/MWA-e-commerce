<?php

namespace App\Traits;

use App\Models\User;

trait HasUser{

    public function user(){
        return $this->belongsto(User::class);
    }
}