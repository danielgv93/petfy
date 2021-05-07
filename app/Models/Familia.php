<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Familia extends User
{
    use HasFactory;

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('user_role_id', 2);
        });
    }

    function mascotas() {
        return $this->belongsToMany(Mascota::class, "adopciones", "familia_id", "mascota_id")->withPivot("fecha_adopcion");
    }
}
