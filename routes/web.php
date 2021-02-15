<?php

use App\Http\Controllers\MascotasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [InicioController::class, "index"])
    ->name("welcome");

Route::get("/mascotas/{especie_id?}", [MascotasController::class, "index"])
    ->name("mascotas")
    ->where("especie", "[0-9]+");

Route::post("/mascotas/busqueda", [MascotasController::class, "busqueda"])
    ->name("mascotas.busqueda");

Route::get("/mascota/{mascota}", [MascotasController::class, "show"])
    ->name("mascotas.show");

Route::get("/administrar-mascotas", [UserController::class, "index"])
    ->name("administrar-mascotas.index")
    ->middleware("auth");

Route::put("/administrar-mascotas/{mascota}", [MascotasController::class, "update"])
    ->name("administrar-mascotas.update")
    ->middleware("auth");

Route::get("/administrar-mascotas/{mascota}/editar", [MascotasController::class, "edit"])
    ->name("administrar-mascotas.edit")
    ->middleware("auth");

Route::get("/administrar-mascotas/crear", [MascotasController::class, "create"])
    ->name("mascotas.create")
    ->middleware("auth");

Route::post("/administrar-mascotas/crear", [MascotasController::class, "store"])
    ->name("mascotas.store")
    ->middleware("auth");

Route::delete("/administrar-mascotas/{mascota}/borrar", [MascotasController::class, "destroy"])
    ->name("mascotas.destroy")
    ->middleware("auth");

// USUARIOS JETSTREAM
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
