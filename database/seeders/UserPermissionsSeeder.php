<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rutasRefugios = array("administrar-mascotas.update", "administrar-mascotas.edit", "mascotas.create",
            "mascotas.store", "mascotas.destroy", "administrar-mascotas.index");
        $rutasFamilias = array("mascotas.adoptar");

        foreach ($rutasRefugios as $rutasFamilia) {
            $userPermission = new UserPermission();
            $userPermission->user_role_id = 1;
            $userPermission->permiso_ruta = $rutasFamilia;
            $userPermission->save();
        }

        foreach ($rutasFamilias as $rutasFamilia) {
            $userPermission = new UserPermission();
            $userPermission->user_role_id = 2;
            $userPermission->permiso_ruta = $rutasFamilia;
            $userPermission->save();
        }
    }
}
