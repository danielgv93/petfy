<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refugio extends User
{
    use HasFactory;

    protected $table = 'users';

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(function ($query) {
            $query->where('user_role_id', 1);
        });
    }

    public function mascotas() {
        return $this->hasMany(Mascota::class);
    }
}
