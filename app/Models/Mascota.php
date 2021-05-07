<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Mascota
 * @package App\Models
 * @property int id
 * @property string nombre
 * @property string slug
 * @property string imagen
 * @property mixed fechaNacimiento
 * @property int peso
 * @property string sexo
 * @property string raza
 * @property string color
 * @property string pelaje
 * @property string descripcion
 * @property string tamano
 * @property int refugio_id
 * @property int especie_id
 * @property boolean adoptado
 * @property mixed fecha_adopcion
 */
class Mascota extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = "mascotas";

    public function especie(){
        return $this->belongsTo(Especie::class);
    }

    public function refugio() {
        return $this->belongsTo(User::class, "refugio_id");
    }

    public function familias() {
        return $this->belongsToMany(User::class, "adopciones", "mascota_id", "familia_id")->withPivot("fecha_adopcion");
    }

    public function hasSolicitudesAdopcion(): bool
    {
        $adopciones = DB::table("adopciones")->where("mascota_id", $this->id);
        return $adopciones->exists();
    }

    public function hasSolicitudesPorFamilia(int $idFamilia): bool
    {
        $adopciones = DB::table("adopciones")
            ->where("mascota_id", $this->id)
            ->where("familia_id", $idFamilia);
        return $adopciones->exists();
    }

    public function adoptar(): void
    {
        $adopcion = Adopcion::query()
            ->where("mascota_id", $this->id)->get()[0];
        $adopcion->fecha_adopcion = now();
        $this->adoptado = true;
        $adopcion->save();
        $this->save();
    }

    public function getEdad()
    {
        $edad = "";
        $fecha = Carbon::parse($this->fechaNacimiento);
        $mesesTotales = $fecha->diffInMonths(Carbon::now());
        $anios = $fecha->diffInYears(Carbon::now());
        $meses = $mesesTotales - $anios * 12;
        if ($anios > 0 || $mesesTotales % 12 === 0 && $anios >= 2) {
            $edad .= "$anios años";
            if ($mesesTotales % 12 !== 0) {
                $edad .= " y $meses meses";
            }
        } else {
            $edad .= "$meses meses";
        }
        return $edad;
    }

    public function isCachorro()
    {
        return Carbon::parse($this->fechaNacimiento)->diffInYears(now()) < 1;
    }

    public function isAdulto() {
        return !$this->isCachorro() && Carbon::parse($this->fechaNacimiento)->diffInYears(now()) < 10;
    }

    public function isAnciano() {
        return !$this->isCachorro() && !$this->isAdulto();
    }

    public static function getRazas()
    {
        return self::query()->distinct()->pluck("raza");
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
