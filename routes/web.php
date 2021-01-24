<?php

use App\Http\Controllers\MascotasController;
use App\Http\Controllers\InicioController;
use App\Models\Refugio;
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

Route::get('/', [InicioController::class, "index"])->name("welcome");

Route::get("/mascotas", [MascotasController::class, "index"])->name("mascotas");

Route::get("/mascotas/crear", [MascotasController::class, "create"])->name("mascotas.crear");

Route::get("/mascota/{id}", [MascotasController::class, "show"])->name("mascotas.show");

Route::get("/mascota/{id}/editar", [MascotasController::class, "edit"])->name("mascotas.editar");

Route::get("/perfil", [Refugio::class, "index"])->name("refugios.index");
