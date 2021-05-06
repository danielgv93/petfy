<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "especies";

    public function mascotas() {
        return $this->hasMany(Mascota::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
