<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\User;
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
        User::factory(3)->create();
        $this->call(UserSeeder::class);
        $this->call(EspecieSeeder::class);
        Mascota::factory(20)->create();
    }
}
