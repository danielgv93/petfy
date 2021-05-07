<?php

namespace Database\Factories;

use App\Models\Especie;
use App\Models\Mascota;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MascotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mascota::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $ai = 1;
        $nombre = $this->faker->lastName;
        $razas = ["Teckle", "Siames", "Border Collie", "Mestizo", "Pastor Aleman"];
        return [
            'nombre' => $nombre,
            'slug' => Str::slug($nombre),
            'imagen' => "mascotas/". $ai++ .".jpg",
                //"https://loremflickr.com/300/200/dog?random=$ai++",
                //$this->faker->imageUrl(300, 200, "animal"),
            "fechaNacimiento" => $this->faker->dateTimeThisDecade,
            "peso" => $this->faker->numberBetween(1, 99),
            "sexo" => $this->faker->randomElement(["Macho", "Hembra"]),
            "raza" => $this->faker->randomElement($razas),
            "color" => $this->faker->safeColorName,
            "pelaje" => $this->faker->randomElement(["Corto", "Largo"]),
            "tamano" => $this->faker->randomElement(["Pequeño", "Mediano", "Grande"]),
            "descripcion" => $this->faker->text(400),
            "refugio_id" => Refugio::all()->random()->id,
            "especie_id" => Especie::all()->random()->id,
        ];
    }
}
