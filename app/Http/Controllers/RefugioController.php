<?php

namespace App\Http\Controllers;

use App\Models\Adopcion;
use App\Models\Familia;
use App\Models\Mascota;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RefugioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $mascotas = Mascota::where("refugio_id", "=", $user_id)
            ->orderBy("created_at", "desc")
            ->paginate(9);
        return view("refugios.mascotas-index", compact("mascotas"));
    }

    public function indexHistorial()
    {
        $aux = Mascota::query()->where("adoptado", true)->orderBy("fecha_adopcion", "desc")->get();
        $adopciones = null;
        foreach ($aux as $mascota) {
            if ($mascota->refugio->id == auth()->user()->id) {
                $adopciones[] = ["mascota" => $mascota, "familia" => $mascota->familias[0]];
            }
        }
        return view("refugios.index-historial", compact("adopciones"));
    }

    public function show(User $refugio)
    {
        return view("refugios.show", compact("refugio"));
    }

    public function indexPeticionesAdopciones()
    {
        $familias = Familia::all();
        $refugio = Refugio::query()->findOrFail(\auth()->user()->id);
        return view("refugios.peticiones-adopcion", compact("familias", "refugio"));
    }

    public function aceptarPeticion(Mascota $mascota, Familia $familia) {
        try {
            Adopcion::query()
                ->where("familia_id", "!=", $familia->id)
                ->where("mascota_id", $mascota->id)
                ->delete();
            Adopcion::query()
                ->where("familia_id", $familia->id)
                ->where("mascota_id", $mascota->id)->get()[0]->save();
            $mascota->adoptar();
            $mensaje = "$familia->name ha adoptado a $mascota->nombre con éxito!";
        } catch (\Exception $e) {
            $mensaje = "No se ha podido adoptar a $mascota->nombre";
        }
        return back()->with("mensaje", $mensaje);
    }
}
