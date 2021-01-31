<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_id = Auth::user()->id;
        $mascotas = Mascota::all()->where("users_id", "=", $users_id);
        return view("refugios.mascotas-index", compact("mascotas"));
    }

    public function edit($id)
    {
        $mascota = Mascota::query()->find($id);
        return view("refugios.mascotas-edit", compact("mascota"));
    }


}
