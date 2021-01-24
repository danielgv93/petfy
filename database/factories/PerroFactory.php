<?php

namespace Database\Factories;

use App\Models\Mascota;
use App\Models\Perro;
use App\Models\Refugio;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mascota_id" => Mascota::all()->random()->id,
            "tamano" => $this->faker->randomElement(["Pequeño", "Mediano", "Grande"]),
        ];
    }
}
