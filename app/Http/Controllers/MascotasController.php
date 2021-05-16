<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Mascota;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as RequestUrl;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MascotasController extends Controller
{
    const PAGINATION = 12;

    /**
     * Se lista a todas las mascotas que cumplan con los filtros de especie y/o caracteristicas y se paginan.
     * @param Especie $especie Especie
     * @return View
     */
    public function index(Especie $especie)
    {
        if (isset($_GET["limpiarFiltro"])) unset($_GET);
        $procedencia = RequestUrl::segment(2);
        // Creacion de la query
        if (!$procedencia) {
            $mascotas = Mascota::query();
        } else {
            $mascotas = Especie::query()->
            find($especie->id)->
            mascotas();
        }
        // Filtrado
        if (isset($_GET["sexo"])) $mascotas->where("sexo", $_GET["sexo"]);
        if (isset($_GET["tamano"])) $mascotas->where("tamano", $_GET["tamano"]);
        if (isset($_GET["raza"]) && $_GET["raza"] != "") $mascotas->where("raza", $_GET["raza"]);
        if (isset($_GET["urgente"])) $mascotas->where("urgente", $_GET["urgente"]);
        if (isset($_GET["sociable"])) $mascotas->where("sociable", $_GET["sociable"]);
        if (isset($_GET["esterilizado"])) $mascotas->where("esterilizado", $_GET["esterilizado"]);

        // Ejecutar query con paginacion
        $mascotas = $mascotas->where("adoptado", false)
            ->paginate(self::PAGINATION);
        return view("mascotas.index", compact("mascotas", "especie"));
    }

    public function busqueda(Request $request)
    {
        $busqueda = "%". $request->busqueda. "%";
        $mascotas = Mascota::query()
            ->where("slug", "like", $busqueda)
            ->pluck("nombre");
        return \response()->json($mascotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view("mascotas.create");
    }

    /**
     * Guarda una mascota en BD
     *
     * @param Request $request Recoge los inputs del formulario
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $mascota = new Mascota();
        $mascota->nombre = $request->nombre;
        $mascota->slug = Str::slug($request->nombre);
        $mascota->especie_id = $request->especie;
        $mascota->fechaNacimiento = $request->fechaNacimiento;
        $mascota->sexo = $request->sexo;
        $mascota->tamano = $request->tamano === "" ? null : $request->tamano;
        $mascota->raza = $request->raza === "" ? null : $request->raza;
        $mascota->color = $request->color === "" ? null : $request->color;
        $mascota->pelaje = $request->pelaje === "" ? null : $request->pelaje;
        $mascota->urgente = $request->urgente === "Si";
        $mascota->sociable = $request->sociable === "-" ? null : $request->urgente === "Si";
        $mascota->esterilizado = $request->esterilizado === "-" ? null : $request->esterilizado === "Si";
        $mascota->descripcion = $request->descripcion === "" ? null : $request->descripcion;
        if ($request->imagen !== null) {
            $mascota->imagen = $request->file("imagen")->store("mascotas");
        }
        $mascota->refugio_id = Auth::user()->id;
        $mascota->save();

        // CONEXION CON LAS APIS
        $sufijo = $mascota->sexo == "Macho" ? "o" : "a";
        $texto = "$request->nombre está list$sufijo para que l$sufijo adoptes! Adoptal$sufijo en http://petfy.es/mascota/$mascota->slug";
        MensajeriaController::postTwitter($texto, $mascota->imagen);
        MensajeriaController::postPhotoTelegram($texto, $mascota->imagen);

        return redirect()->route("administrar-mascotas.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Mascota $mascota
     * @return View
     */
    public function show(Mascota $mascota)
    {
        return view("mascotas.show", compact("mascota"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mascota $mascota
     * @return View
     */
    public function edit(Mascota $mascota)
    {
        return view("refugios.mascotas-edit", compact("mascota"));
    }

    /**
     * Actualizar la informacion de la mascota pasada por parametros.
     *
     * @param Request $request Recoge los inputs del formulario
     * @param Mascota $mascota Mascota a la que se le van a actualizar sus valores
     * @return RedirectResponse
     */
    public function update(Request $request, Mascota $mascota)
    {
        $mascota->nombre = $request->nombre;
        $mascota->slug = Str::slug($request->nombre);
        $mascota->fechaNacimiento = $request->fechaNacimiento;
        $mascota->sexo = $request->sexo;
        $mascota->tamano = $request->tamano === "" ? null : $request->tamano;
        $mascota->raza = $request->raza === "" ? null : $request->raza;
        $mascota->color = $request->color === "" ? null : $request->color;
        $mascota->pelaje = $request->pelaje === "" ? null : $request->pelaje;
        $mascota->urgente = $request->urgente === "Si";
        $mascota->sociable = $request->sociable === "-" ? null : $request->urgente === "Si";
        $mascota->esterilizado = $request->esterilizado === "-" ? null : $request->esterilizado === "Si";
        $mascota->descripcion = $request->descripcion === "" ? null : $request->descripcion;
        if ($request->imagen !== null) {
            // Borra la imagen anterior y guarda una nueva con nuevo nombre
            Storage::delete($mascota->imagen);
            $mascota->imagen = $request->file("imagen")->store("mascotas");
        }
        $mascota->save();
        return redirect()->route("administrar-mascotas.index");
    }

    /**
     * El usuario genera una solicitud de adopción sobre la mascota pasada por parámetro y se guarda en la tabla "adopciones".
     * Si el usuario ya ha enviado una solicitud, se le informa pero no se guarda nada en BD.
     * @param Request $request Recoge el input id de mascota
     * @return RedirectResponse
     */
    public function solicitarAdopcion(Request $request)
    {
        $mascota = Mascota::query()->findOrFail($request->id);
        $familia = auth()->user()->id;
        if ($mascota->hasSolicitudesPorFamilia($familia)) {
            $mensaje = "No puedes solicitar otra adopción por $mascota->nombre. Ya lo has hecho anteriormente.";
        } else {
            if ($mascota->hasSolicitudesAdopcion()) {
                $mensaje = "$mascota->nombre parece que esta muy solicitado. Has enviado una solicitud de adopción.";
            } else {
                $mensaje = "Has enviado una solicitud de adopción por $mascota->nombre.";
            }
            DB::table("adopciones")->where("mascota_id", $request->id)->where("familia_id", $familia);
            $mascota->familias()->attach([$familia]);
        }
        return redirect()->route("mascotas")->with("mensaje", $mensaje);
    }

    /**
     * Elimina una mascota de la base de datos
     *
     * @param Mascota $mascota Mascota que se quiere eliminar
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route("administrar-mascotas.index");
    }



}
