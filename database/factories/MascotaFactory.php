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
        return [
            'nombre' => $this->faker->lastName,
            'imagen' => $this->faker->imageUrl(300, 200, "animals"),
            "fechaNacimiento" => $this->faker->date(),
            "peso" => $this->faker->numberBetween(1, 99),
            "sexo" => $this->faker->randomElement(["M", "F"]),
            "users_id" => User::all()->random()->id,
            "especies_id" => Especie::all()->random()->id,
        ];
    }
}
