<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Refugio;
use App\Models\Gato;
use App\Models\Perro;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Refugio::factory(3)->create();
        $this->call(MascotaSeeder::class);

    }
}
