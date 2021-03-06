<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class MascotasController extends Controller
{
    const PAGINATION = 9;

    /**
     * Display a listing of the resource.
     *
     * @param int|null $especie_id
     * @return Response
     */
    public function index(int $especie_id = null)
    {
        $mascotas = Mascota::query()->
        when($especie_id, function ($query, $especie_id) {
                return $query->where("especie_id", $especie_id);
            })
            ->orderBy("created_at")
            ->paginate(self::PAGINATION);
        return view("mascotas.index", compact("mascotas", "especie_id"));
    }

    public function busqueda(Request $request)
    {
        $busqueda = "%". $request->busqueda. "%";
        $especie_id = $request->especie;
        $mascotas = Mascota::query()
            ->where("slug", "like", $busqueda)
            ->when($especie_id, function ($q, $especie_id) {
                $q->where('especie_id', $especie_id);
            })
            ->orderBy("created_at")
            ->paginate(self::PAGINATION);
        return view("mascotas.index", compact("mascotas", "especie_id"));
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
        $mascota->fechaNacimiento = $request->fechaNacimiento;
        $mascota->peso = $request->peso;
        $mascota->sexo = $request->sexo;
        $mascota->user_id = Auth::user()->id;
        $mascota->especie_id = $request->especie;
        if ($request->raza === "") {
            $mascota->raza = null;
        } else {
            $mascota->raza = $request->raza;
        }
        if ($request->color === "") {
            $mascota->color = null;
        } else {
            $mascota->color = $request->color;
        }
        if ($request->pelaje === "") {
            $mascota->pelaje = null;
        } else {
            $mascota->pelaje = $request->pelaje;
        }
        if ($request->tamano === "") {
            $mascota->tamano = null;
        } else {
            $mascota->tamano = $request->tamano;
        }
        if ($request->descripcion === "") {
            $mascota->descripcion = null;
        } else {
            $mascota->descripcion = $request->descripcion;
        }
        if ($request->imagen !== null) {
            $mascota->imagen = $request->file("imagen")->store("mascotas");
        }
        $mascota->save();

        // Enviar mensaje Telegram
        $sufijo = $mascota->sexo == "Macho" ? "o" : "a";
        $texto = "*$request->nombre* está list$sufijo para que l$sufijo adoptes!. Adoptal$sufijo en https://petfy.es/mascota/$mascota->slug";
        Telegram::sendMessage([
            'chat_id' => env("TELEGRAM_CHANNEL_ID"),
            "text" => $texto,
            "parse_mode" => "Markdown"
        ]);
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
        $mascota->peso = $request->peso;
        $mascota->sexo = $request->sexo;
        if ($request->raza === "") {
            $mascota->raza = null;
        } else {
            $mascota->raza = $request->raza;
        }
        if ($request->color === "") {
            $mascota->color = null;
        } else {
            $mascota->color = $request->color;
        }
        if ($request->pelaje === "") {
            $mascota->pelaje = null;
        } else {
            $mascota->pelaje = $request->pelaje;
        }
        if ($request->tamano === "") {
            $mascota->tamano = null;
        } else {
            $mascota->tamano = $request->tamano;
        }
        if ($request->descripcion === "") {
            $mascota->descripcion = null;
        } else {
            $mascota->descripcion = $request->descripcion;
        }
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
        // QUITAR DE LA BASE DE DATOS
        $texto = "Han adoptado a *$mascota->nombre*!!! Si tu también quieres adoptar entra aquí para hacerlo https://petfy.es/";
        Telegram::sendMessage([
            'chat_id' => env("TELEGRAM_CHANNEL_ID"),
            "text" => $texto,
            "parse_mode" => "Markdown"
        ]);
        return redirect()->route("mascotas")->with("mensaje", "Has adoptado a $mascota->nombre!");
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
