<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    use HasFactory;

    protected $table = "user_roles";
    public $timestamps = false;

    public function usuarios() {
        return $this->hasMany(User::class);
    }

    public function permisos() {
        return $this->hasMany(UserPermission::class, "user_role_id");
    }
}
