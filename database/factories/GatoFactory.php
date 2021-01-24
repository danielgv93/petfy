<?php

namespace Database\Factories;

use App\Models\Gato;
use App\Models\Mascota;
use App\Models\Refugio;
use Illuminate\Database\Eloquent\Factories\Factory;

class GatoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mascota_id" => Mascota::all()->random()->id,
            "pelo" => $this->faker->randomElement(["Corto", "Largo"]),
        ];
    }
}
