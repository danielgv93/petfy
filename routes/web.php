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

Route::get("/mascotas", [MascotasController::class, "index"])
    ->name("mascotas");

Route::get("/mascotas/perros", [MascotasController::class, "perros"])
    ->name("mascotas.perros");

Route::get("/mascotas/gatos", [MascotasController::class, "gatos"])
    ->name("mascotas.gatos");

Route::get("/mascotas/crear", [MascotasController::class, "create"])
    ->name("mascotas.crear");

Route::get("/mascota/{mascota}", [MascotasController::class, "show"])
    ->name("mascotas.show");

Route::get("/administrar-mascotas", [UserController::class, "index"])
    ->name("administrar-mascotas.index")
    ->middleware("auth");

Route::put("/administrar-mascotas/{mascota}", [MascotasController::class, "update"])
    ->name("administrar-mascotas.update")
    ->middleware("auth");

Route::get("/administrar-mascotas/{mascota}/editar", [UserController::class, "edit"])
    ->name("administrar-mascotas.edit")
    ->middleware("auth");


// USUARIOS JETSTREAM
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
