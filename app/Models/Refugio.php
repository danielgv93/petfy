<?php

namespace App\Models;

use App\Http\Controllers\RefugioController;
use App\Mail\Gmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

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

    public static function rechazarSolicitudes(Mascota $mascota, Familia $familia)
    {
        $idsRechazo = Adopcion::query()
            ->where("familia_id", "!=", $familia->id)
            ->where("mascota_id", $mascota->id)->pluck("familia_id");
        $emails = User::query()->whereIn('id', $idsRechazo)->pluck("email");
        if (isset($emails)) {
            $details = [
                "title" => "Solicitud de adopción de $mascota->nombre rechazada",
                "body" => Refugio::rechazarPetcionHTML($mascota)
            ];
            foreach ($emails as $email) {
                Mail::to($email)->send(new Gmail($details, "Solicitud Adopción"));
            }
        }
        Adopcion::query()
            ->where("familia_id", "!=", $familia->id)
            ->where("mascota_id", $mascota->id)
            ->delete();
    }

    public static function aceptarSolicitudes(Mascota $mascota, Familia $familia) {
        $details = [
            "title" => "$mascota->nombre adoptado",
            "body" => Refugio::aceptarPetcionHTML($mascota, $mascota->refugio)
        ];
        Mail::to($familia->email)->send(new Gmail($details, "Solicitud Adopción"));
        Adopcion::query()
            ->where("familia_id", $familia->id)
            ->where("mascota_id", $mascota->id)->get()[0]->save();
        $mascota->adoptar();
    }

    private static function rechazarPetcionHTML(Mascota $mascota)
    {
        return "Lo sentimos mucho, pero no has podido adoptar a $mascota->nombre. El refugio ha decidido
                entregarselo a otra familia. Pero no desesperes!! Hay muchas otras mascotas deseando que las acojas. Entra en www.petfy.es y
                enamórate de tu futura mascota.";
    }

    private static function aceptarPetcionHTML(Mascota $mascota, User $refugio)
    {
        return "¡¡Enhorabuena, $refugio->name ha aceptado tu solicitud de adopción sobre $mascota->nombre!!
                Podrás venir a recoger a $mascota->nombre a las instalaciones en $refugio->direccion";
    }
}
