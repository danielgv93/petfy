<?php

namespace Database\Seeders;

use App\Models\Gato;
use App\Models\Mascota;
use App\Models\Perro;
use Illuminate\Database\Seeder;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mascotas = Mascota::factory(20)->create();
        $aux = true;

        foreach ($mascotas as $mascota) {
            if ($aux) {
                Perro::factory(1)->create(["mascota_id" => $mascota->id]);
                $aux = false;
            } else {
                Gato::factory(1)->create(["mascota_id" => $mascota->id]);
                $aux = true;
            }
        }
    }
}
