<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function perro(){
        return $this->hasOne(Perro::class);
    }

    public function gato(){
        return $this->hasOne(Gato::class);
    }
}
