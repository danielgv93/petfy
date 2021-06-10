<?php

namespace Database\Seeders;

use App\Models\Especie;
use App\Models\Mascota;
use App\Models\Refugio;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MascotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create("es_ES");
        $razas = ["Teckle", "Siames", "Border Collie", "Mestizo", "Pastor Aleman"];
        for ($i = 1; $i <= 49; $i++) {
            $mascota = new Mascota();
            $nombre = $faker->lastName;
            $mascota->nombre = $nombre;
            $mascota->slug = Str::slug($nombre);
            $mascota->imagen = "mascotas/". $i .".jpg";
            $mascota->fechaNacimiento = $faker->dateTimeThisDecade;
            $mascota->sexo = $faker->randomElement(["Macho", "Hembra"]);
            $mascota->raza = $faker->randomElement($razas);
            $mascota->sociable = $faker->boolean;
            $mascota->esterilizado = $faker->boolean(70);
            $mascota->color = $faker->safeColorName;
            $mascota->pelaje = $faker->randomElement(["Corto", "Largo"]);
            $mascota->tamano = $faker->randomElement(["Pequeño", "Mediano", "Grande"]);
            $mascota->descripcion = $faker->text(400);
            $mascota->refugio_id = Refugio::all()->random()->id;
            $mascota->especie_id = $i % 2 === 0 ? 2 : 1;
            $mascota->save();
        }

    }
}
