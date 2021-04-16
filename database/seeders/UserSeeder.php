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
        $nombre = "Dani";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 2;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
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
        $usuario->latitud = 43.354763751156746;
        $usuario->longitud =  -4.075958235989857;
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Aspacan";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 1;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->password = bcrypt("123");
        $usuario->latitud = 43.407448;
        $usuario->longitud = -3.414076;
        $usuario->remember_token = Str::random(10);
        $usuario->save();

        $nombre = "Patas Cantabria";
        $slug = Str::slug($nombre);
        $usuario = new User();
        $usuario->name = $nombre;
        $usuario->user_role_id = 1;
        $usuario->slug = $slug;
        $usuario->email = "$slug@gmail.com";
        $usuario->password = bcrypt("123");
        $usuario->latitud = 43.37920485595216;
        $usuario->longitud = -4.39873934601478;
        $usuario->remember_token = Str::random(10);
        $usuario->save();

    }
}
