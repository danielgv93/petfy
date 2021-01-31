<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function especie(){
        return $this->belongsTo(Especie::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class);
    }
}
