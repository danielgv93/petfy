<?php

namespace Database\Seeders;

use App\Models\UserRol;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new UserRol();
        $rol->role_name = "Refugio";
        $rol->save();

        $rol = new UserRol();
        $rol->role_name = "Familia";
        $rol->save();
    }
}
