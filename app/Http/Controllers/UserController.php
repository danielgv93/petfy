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
        $mascotas = Mascota::where("users_id", "=", $users_id)->paginate(9);
        return view("refugios.mascotas-index", compact("mascotas"));
    }
}
