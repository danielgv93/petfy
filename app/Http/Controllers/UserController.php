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
        $user_id = Auth::user()->id;
        $mascotas = Mascota::where("user_id", "=", $user_id)
            ->orderBy("created_at", "desc")
            ->paginate(9);
        return view("refugios.mascotas-index", compact("mascotas"));
    }

    public function show(User $refugio)
    {
        return view("refugios.show", compact("refugio"));
    }
}
