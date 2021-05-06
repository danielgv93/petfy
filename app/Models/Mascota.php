<?php

namespace App\Models;

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
 * @property mixed created_at
 * @property mixed updated_at
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
        return $this->belongsToMany(User::class, "adopciones", "mascota_id", "familia_id");
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
        $this->adoptado = true;
        $this->fecha_adopcion = now();
        $this->save();
    }

    public function isAdoptado(): bool
    {
        $adoptado = DB::table("adopciones")->where("adopcion_final", true);
        return $adoptado->exists();
    }

    public function getRouteKeyName()
    {
        return "slug";
    }
}
