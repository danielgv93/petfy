<?php

namespace Database\Factories;

use App\Models\Especie;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $id = $this->faker->numberBetween(1, 100);
        return [
            'nombre' => $this->faker->lastName,
            'imagen' => //"https://loremflickr.com/300/200/dog?random=$id",
                $this->faker->imageUrl(300, 200, "animal"),
            "fechaNacimiento" => $this->faker->date(),
            "peso" => $this->faker->numberBetween(1, 99),
            "sexo" => $this->faker->randomElement(["M", "F"]),
            "raza" => $this->faker->randomElement(["Teckle", "Siames", "Border Collie", "Mestizo", "Pastor Aleman"]),
            "color" => $this->faker->safeColorName,
            "pelaje" => $this->faker->randomElement(["Corto", "Largo"]),
            "descripcion" => $this->faker->text(400),
            "users_id" => User::all()->random()->id,
            "especies_id" => Especie::all()->random()->id,
            "tamano" => $this->faker->randomElement(["Pequeño", "Mediano", "Grande"]),
        ];
    }
}
