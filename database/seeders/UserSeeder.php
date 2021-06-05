<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create("es_ES");
        $nombre = "Dani";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 2;
        $usuario->slug = $slug;
        $usuario->email = "danielgarciavarela93@gmail.com";
        $usuario->ciudad = "Torrelavega";
        $usuario->direccion = "Calle Campoo, 6";
        $usuario->nif = "72152050S";
        $usuario->sobre_mi = "Enamorado de los gatos y los perros. Tengo una perrita que se llama Nami y busco a alguien
            para hacerla compañía.";
        $usuario->password = bcrypt("123");
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Usuario2";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 2;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->direccion = $faker->streetAddress;
        $usuario->ciudad = $faker->city;
        $usuario->nif = $faker->dni;
        $usuario->sobre_mi = "Me gustan los gatos y tengo ya dos, un siames y un persa. Me gustaría encontrar un bebe gatito
            para que se una a la familia.";
        $usuario->password = bcrypt("123");
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Usuario3";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 2;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->direccion = $faker->streetAddress;
        $usuario->ciudad = $faker->city;
        $usuario->nif = $faker->dni;
        $usuario->sobre_mi = "Soy un activista animal y busco un animal, me da igual el que sea, para cuidarlo y darle
            acogida.";
        $usuario->password = bcrypt("123");
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Refugio Canino de Torres";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 1;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->password = bcrypt("123");
        $usuario->nif = $faker->dni;
        $usuario->latitud = 43.354763751156746;
        $usuario->longitud =  -4.075958235989857;
        $usuario->ciudad =  "Torrelavega";
        $usuario->direccion = $faker->streetAddress;
        $usuario->direccion_donacion =  "$slug@paypal.com";
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Aspacan";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 1;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->nif = $faker->dni;
        $usuario->password = bcrypt("123");
        $usuario->latitud = 43.407448;
        $usuario->longitud = -3.414076;
        $usuario->ciudad =  "Laredo";
        $usuario->direccion = $faker->streetAddress;
        $usuario->direccion_donacion =  "$slug@paypal.com";
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Patas Cantabria";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 1;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->nif = $faker->dni;
        $usuario->password = bcrypt("123");
        $usuario->latitud = 43.37920485595216;
        $usuario->longitud = -4.39873934601478;
        $usuario->ciudad =  "San Vicente de la Barquera";
        $usuario->direccion = $faker->streetAddress;
        $usuario->direccion_donacion =  "$slug@paypal.com";
        $usuario->remember_token = Str::random(10);
        $usuario->save();

    }
}
