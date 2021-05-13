<?php

use App\Http\Controllers\MapaController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\MensajeriaController;
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

Route::get("/mascotas/{especie?}", [MascotasController::class, "index"])
    ->name("mascotas");

Route::post("/mascotas/busqueda", [MascotasController::class, "busqueda"])
    ->name("mascotas.busqueda");

Route::get("/mascota/{mascota}", [MascotasController::class, "show"])
    ->name("mascotas.show");

Route::post("/mascota/adoptar", [MascotasController::class, "solicitarAdopcion"])
    ->name("mascotas.adoptar")
    ->middleware(["accessrole", "auth"]);

Route::put("/dashboard/administrar-mascotas/{mascota}", [MascotasController::class, "update"])
    ->name("administrar-mascotas.update")
    ->middleware(["accessrole", "auth"]);

Route::get("/dashboard/administrar-mascotas/{mascota}/editar", [MascotasController::class, "edit"])
    ->name("administrar-mascotas.edit")
    ->middleware(["accessrole", "auth"]);

Route::get("/dashboard/anadir-mascota", [MascotasController::class, "create"])
    ->name("mascotas.create")
    ->middleware(["accessrole", "auth"]);

Route::post("/dashboard/administrar-mascotas/crear", [MascotasController::class, "store"])
    ->name("mascotas.store")
    ->middleware(["accessrole", "auth"]);

Route::delete("/dashboard/administrar-mascotas/{mascota}/borrar", [MascotasController::class, "destroy"])
    ->name("mascotas.destroy")
    ->middleware(["accessrole", "auth"]);

Route::get("/refugio/{refugio}", [RefugioController::class, "show"])
    ->name("refugio.show");

Route::get("/dashboard/administrar-mascotas", [RefugioController::class, "index"])
    ->name("administrar-mascotas.index")
    ->middleware(["accessrole", "auth"]);

Route::get("/dashboard/peticiones-adopcion", [RefugioController::class, "indexPeticionesAdopciones"])
    ->name("peticiones-adopcion")
    ->middleware(["accessrole", "auth"]);

Route::get("/dashboard/peticiones-adopcion/aceptar-peticion/{mascota}/{familia}", [RefugioController::class, "aceptarSolicitud"])
    ->name("aceptar-peticion")
    ->middleware(["accessrole", "auth"]);

Route::get("/dashboard/historial-adopciones", [RefugioController::class, "indexHistorial"])
    ->name("historial-adopciones")
    ->middleware(["accessrole", "auth"]);

// APIS
Route::get("telegram/getMe", [MensajeriaController::class, "getMe"])
    ->name("telegram.getMe");

Route::post("telegram/store", [MensajeriaController::class, "mascotaNueva"])
    ->name("telegram.store");

Route::any("maps/generar/{refugio}", [MapaController::class, "generarXML"])
    ->name("maps.xml");

// USUARIOS JETSTREAM
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
