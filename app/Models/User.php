<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 * @property $id
 * @property $name
 * @property $slug
 * @property $user_role_id
 * @property $email
 * @property $password
 * @property $direccion
 * @property $ciudad
 * @property $nif
 * @property $sobre_mi
 * @property $latitud
 * @property $longitud
 * @property $direccion_donacion
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        "slug",
        'password',
        "user_role_id",
        "nif",
        "direccion"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function rol() {
        return $this->belongsTo(UserRol::class, "user_role_id");
    }

    public function isRefugio() {
        return $this->user_role_id == 1;
    }

    public function isFamilia() {
        return $this->user_role_id == 2;
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
