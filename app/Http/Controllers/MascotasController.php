<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MascotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = Mascota::paginate(9);
        return view("mascotas.index", compact("mascotas"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mascotas.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mascota = new Mascota();
        $mascota->nombre = $request->nombre;
        $mascota->slug = Str::slug($request->nombre);
        $mascota->fechaNacimiento = $request->fechaNacimiento;
        $mascota->peso = $request->peso;
        $mascota->sexo = $request->sexo;
        $mascota->users_id = Auth::user()->id;
        $mascota->especies_id = $request->especie;
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
            $mascota->imagen = $request->file("imagen")->storeAs("", Str::slug($request->nombre).".".$request->file("imagen")->extension());
        } else {
            // Establece el nombre de la imagen por el nombre que se edite
            $cadena = explode(".", $mascota->imagen);
            $nuevoFichero = Str::slug($request->nombre).".$cadena[1]";
            Storage::copy($mascota->imagen, $nuevoFichero);//TODO: Cambiar por metodo move() al subir a producción
            $mascota->imagen = $nuevoFichero;
        }

        $mascota->save();
        return redirect()->route("administrar-mascotas.index");
    }

    /**
     * Display the specified resource.
     *
     * @param Mascota $mascota
     * @return \Illuminate\Http\Response
     */
    public function show(Mascota $mascota)
    {
        return view("mascotas.show", compact("mascota"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mascota $mascota
     * @return \Illuminate\Http\Response
     */
    public function edit(Mascota $mascota)
    {
        return view("refugios.mascotas-edit", compact("mascota"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Mascota $mascota
     * @return \Illuminate\Http\Response
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
            $mascota->imagen = $request->file("imagen")->storeAs("", Str::slug($request->nombre).".".$request->file("imagen")->extension());
        } else {
            // Establece el nombre de la imagen por el nombre que se edite
            $cadena = explode(".", $mascota->imagen);
            $nuevoFichero = Str::slug($request->nombre).".$cadena[1]";
            Storage::copy($mascota->imagen, $nuevoFichero);//TODO: Cambiar por metodo move() al subir a producción
            $mascota->imagen = $nuevoFichero;
        }
        $mascota->save();
        return redirect()->route("administrar-mascotas.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function perros()
    {
        $perros = Mascota::where("especies_id", "=", 1)->paginate(9);
        return view("mascotas.perros", compact("perros"));
    }

    public function gatos()
    {
        $gatos = Mascota::where("especies_id", "=", 2)->paginate(9);
        return view("mascotas.gatos", compact("gatos"));
    }
}
