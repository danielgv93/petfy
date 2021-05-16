<?php

namespace App\Models;

use App\Mail\Gmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade as PDF;

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

    /**
     * Envía una notificación por email a los usuarios cuyas solicitudes han sido rechazadas y borra
     * de la tabla Adopción el registro de dichas solicitudes
     * @param Mascota $mascota
     * @param Familia $familia
     */
    public static function rechazarSolicitudes(Mascota $mascota, Familia $familia)
    {
        $rechazados = Adopcion::query()
            ->where("familia_id", "!=", $familia->id)
            ->where("mascota_id", $mascota->id)->pluck("familia_id");
        if ($rechazados->count() > 0) {
            $idsRechazados = $rechazados->pluck("familia_id");
            $emails = User::query()->whereIn('id', $idsRechazados)->pluck("email");
        }

        if (isset($emails)) {
            $details = [
                "title" => "Solicitud de adopción de $mascota->nombre rechazada",
                "body" => self::rechazarPetcionHTML($mascota)
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
    /**
     * Se establece que la mascota pasa a estado adoptado y envía una notificación por email
     * al usuario cuya solicitud ha sido aceptada
     * @param Mascota $mascota
     * @param Familia $familia
     */
    public static function aceptarSolicitudes(Mascota $mascota, Familia $familia) {
        $refugio = $mascota->refugio;
        $details = [
            "title" => "$mascota->nombre adoptado",
            "body" => self::aceptarPetcionHTML($mascota, $refugio)
        ];
        $mascota->adoptar();
        $pdf = PDF::loadview("pdf.contrato", compact("mascota", "familia", "refugio"));
        Mail::to($familia->email)->send(new Gmail($details, "Solicitud Adopción", $pdf->output(), "Contrato $mascota->nombre.pdf"));

    }

    /**
     * Genera el contenido de texto para enviar por correo como notificación al rechazar una solicitud
     * @param Mascota $mascota
     * @return string Contenido del correo
     */
    private static function rechazarPetcionHTML(Mascota $mascota): string
    {
        return "Lo sentimos mucho, pero no has podido adoptar a $mascota->nombre. El refugio ha decidido
                entregarselo a otra familia. Pero no desesperes!! Hay muchas otras mascotas deseando que las acojas. Entra en www.petfy.es y
                enamórate de tu futura mascota.";
    }

    /**
     * Genera el contenido de texto para enviar por correo como notificación al aceptar una solicitud
     * @param Mascota $mascota
     * @param User $refugio
     * @return string Contenido del correo
     */
    private static function aceptarPetcionHTML(Mascota $mascota, User $refugio): string
    {
        return "¡¡Enhorabuena, $refugio->name ha aceptado tu solicitud de adopción sobre $mascota->nombre!!
                Podrás venir a recoger a $mascota->nombre a las instalaciones en $refugio->direccion. Se adjunta el
                contrato que deberá de ser entregado y firmado a la recogida de la mascota.";
    }
}
