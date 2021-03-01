<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

//    public function funds()
//    {
//        return $this->hasManyThrough(Fund::class, Investment::class);
//    }
}
