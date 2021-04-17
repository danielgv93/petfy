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
        $rol->role_name = "refugio";
        $rol->save();

        $rol = new UserRol();
        $rol->role_name = "familia";
        $rol->save();
    }
}
