<?php

namespace App\Http\Controllers;

use App\Models\User;
use DOMDocument;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MapaController extends Controller
{
    /**
     * Genera el fichero XML necesario para mostrar en un mapa las coordenadas del refugio
     * @param int $id Identificador del refugio
     * @return Application|ResponseFactory|Response
     */
    public function generarXML(int $id) {
        $refugio = User::query()->findOrFail($id);
        $dom = new DOMDocument("1.0");
        $nodo = $dom->createElement("markers");
        $nodoPadre = $dom->appendChild($nodo);

        $nodo = $dom->createElement("marker");
        $nodoMarker = $nodoPadre->appendChild($nodo);
        $nodoMarker->setAttribute("id", $refugio->id);
        $nodoMarker->setAttribute("name", $refugio->name);
        $nodoMarker->setAttribute("lat", $refugio->latitud);
        $nodoMarker->setAttribute("lng", $refugio->longitud);
        $xml = $dom->saveXML();
        return response($xml, 200)->header("Content-type", "text/xml");
    }
}
