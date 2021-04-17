<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;

    protected $table = "user_permissions";

    public $timestamps = false;

    public function rol() {
        return $this->belongsTo(UserRol::class, "user_role_id");
    }
}
