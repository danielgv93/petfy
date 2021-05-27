<?php

namespace App\Http\Middleware;


use App\Models\UserPermission;
use App\Models\UserRol;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Comprobar que el usuario esta registrado
        try {
            $usuarioRol = auth()->user()->rol;
        } catch (\ErrorException $e) {
            return $next($request);
        }

        $rutaActual = Route::currentRouteName();
        $permisos = $usuarioRol->permisos()->pluck("permiso_ruta");
        for ($i = 0; $i < count($permisos); $i++) {
            $aux[] = strval($permisos[$i]);
        }
        $permisos = $aux;
        if (in_array($rutaActual, $permisos)) {
            return $next($request);
        } else {
            abort(403, "No puedes acceder a esta pagina con este usuario"); //TODO: Hacer una vista
        }

    }
}
