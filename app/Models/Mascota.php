<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "mascotas";

    public function especie(){
        return $this->belongsTo(Especie::class);
    }

    public function refugio() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
