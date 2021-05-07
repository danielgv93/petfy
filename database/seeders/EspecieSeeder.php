<?php

namespace Database\Seeders;

use App\Models\Especie;
use Illuminate\Database\Seeder;

class EspecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $especies = array(
            "Perro",
            "Gato"
        );

        foreach ($especies as $especie) {
            $objeto = new Especie();
            $objeto->especie = $especie;
            $objeto->slug = strtolower($especie)."s";
            $objeto->save();
        }
    }
}
