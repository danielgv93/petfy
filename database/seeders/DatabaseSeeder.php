<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\User;
use App\Models\UserPermission;
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
        $this->call(UserRolesSeeder::class);
        $this->call(UserPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EspecieSeeder::class);
        $this->call(MascotaSeeder::class);
        /*Mascota::factory(44)->create();*/
    }
}
