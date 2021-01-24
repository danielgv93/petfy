<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gato extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function gato() {
        return $this->belongsTo(Mascota::class);
    }
}
