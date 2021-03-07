<?php

namespace App\Http\Controllers;

use App\Models\User;
use DOMDocument;
use Illuminate\Http\Request;

class MapaController extends Controller
{
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
