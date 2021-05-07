<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Mascota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MascotasController extends Controller
{
    const PAGINATION = 9;

    /**
     * Display a listing of the resource.
     * @param Especie $especie
     * @return Response
     */
    public function index(Especie $especie)
    {
        $procedencia = \Illuminate\Support\Facades\Request::segment(2);
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
        if (isset($_GET["peso"])) $mascotas->where("peso", $_GET["peso"]);

        // Ejecutar query con paginacion
        $mascotas = $mascotas->paginate(self::PAGINATION);
        return view("mascotas.index", compact("mascotas", "especie"));
    }

    public function busqueda(Request $request)
    {
        $busqueda = "%". $request->busqueda. "%";
        $mascotas = Mascota::query()
            ->where("slug", "like", $busqueda)
            ->orderBy("created_at")
            ->pluck("nombre");
        return \response()->json($mascotas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("mascotas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
     * @return Response
     */
    public function show(Mascota $mascota)
    {
        return view("mascotas.show", compact("mascota"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mascota $mascota
     * @return Response
     */
    public function edit(Mascota $mascota)
    {
        return view("refugios.mascotas-edit", compact("mascota"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Mascota $mascota
     * @return Response
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
            // Borra la imagen anterior y guarda una nueva con (o sin) nuevo nombre
            Storage::delete($mascota->imagen);
            $mascota->imagen = $request->file("imagen")->store("mascotas");
        }
        $mascota->save();
        return redirect()->route("administrar-mascotas.index");
    }


    public function adoptar(Request $request)
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
     * Remove the specified resource from storage.
     *
     * @param Mascota $mascota
     * @return Response
     * @throws Exception
     */
    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return redirect()->route("administrar-mascotas.index");
    }



}
