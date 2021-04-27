<?php

use App\Http\Controllers\MapaController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\RefugioController;
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

Route::post("/mascota/adoptar", [MascotasController::class, "adoptar"])
    ->name("mascotas.adoptar")
    ->middleware(["accessrole", "auth"]);

Route::put("/administrar-mascotas/{mascota}", [MascotasController::class, "update"])
    ->name("administrar-mascotas.update")
    ->middleware(["accessrole", "auth"]);

Route::get("/administrar-mascotas/{mascota}/editar", [MascotasController::class, "edit"])
    ->name("administrar-mascotas.edit")
    ->middleware(["accessrole", "auth"]);

Route::get("/administrar-mascotas/crear", [MascotasController::class, "create"])
    ->name("mascotas.create")
    ->middleware(["accessrole", "auth"]);

Route::post("/administrar-mascotas/crear", [MascotasController::class, "store"])
    ->name("mascotas.store")
    ->middleware(["accessrole", "auth"]);

Route::delete("/administrar-mascotas/{mascota}/borrar", [MascotasController::class, "destroy"])
    ->name("mascotas.destroy")
    ->middleware(["accessrole", "auth"]);

Route::get("/refugio/{refugio}", [RefugioController::class, "show"])
    ->name("refugio.show");

Route::get("/administrar-mascotas", [RefugioController::class, "index"])
    ->name("administrar-mascotas.index")
    ->middleware(["accessrole", "auth"]);

Route::get("/administrar-mascotas/peticiones-adopcion", [RefugioController::class, "indexPeticionesAdopciones"])
    ->name("peticiones-adopcion")
    ->middleware(["accessrole", "auth"]);

Route::get("/administrar-mascotas/aceptar-peticion/{mascota}/{familia}", [RefugioController::class, "aceptarPeticion"])
    ->name("aceptar-peticion")
    ->middleware(["accessrole", "auth"]);

Route::get("/administrar-mascotas/historial-adopciones", [RefugioController::class, "indexHistorial"])
    ->name("historial-adopciones")
    ->middleware(["accessrole", "auth"]);

// APIS
Route::get("telegram/getMe", [TelegramController::class, "getMe"])
    ->name("telegram.getMe");

Route::post("telegram/store", [TelegramController::class, "mascotaNueva"])
    ->name("telegram.store");

Route::any("maps/generar/{id}", [MapaController::class, "generarXML"])
    ->name("maps.xml");

// USUARIOS JETSTREAM
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
