<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\Refugio;
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
            'imagen' => $this->faker->imageUrl(300, 200, "animals", true),
            "fechaNacimiento" => $this->faker->date(),
            "peso" => $this->faker->numberBetween(1, 99),
            "sexo" => $this->faker->randomElement(["M", "F"]),
            "refugio_id" => Refugio::all()->random()->id,
        ];
    }
}
