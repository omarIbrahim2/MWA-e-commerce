<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Admin extends User
{
    use HasFactory;

    use HasUser;
    protected $guarded = ['id', 'created_at','updated_at'];
}
