<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refugio extends Model
{
    use HasFactory;

    protected $table = "refugios";
    public $timestamps = false;

    public function mascotas() {
        return $this->hasMany(Mascota::class);
    }
}
