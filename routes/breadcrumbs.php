<?php

use App\Models\Especie;
use App\Models\Mascota;
use App\Models\User;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('welcome'));
});
// Home > Perfil
Breadcrumbs::for('perfil', function ($trail) {
    $trail->parent('home');
    $trail->push('Perfil', route('profile.show'));
});
// Home > About Us
Breadcrumbs::for('about-us', function ($trail) {
    $trail->parent("home");
    $trail->push('Sobre nosotros', route('about-us'));
});
// Home > Refugio
Breadcrumbs::for('refugio.show', function ($trail, User $refugio) {
    $trail->parent("home");
    $trail->push('Refugio', route('refugio.show', compact("refugio")));
});

// Home > Mascotas
Breadcrumbs::for('mascotas', function ($trail) {
    $trail->parent("home");
    $trail->push('Mascotas', route('mascotas'));
});

// Home > Mascotas > Perros
Breadcrumbs::for('mascotas.perros', function ($trail) {
    $trail->parent('mascotas');
    $trail->push('Perros', route('mascotas', Especie::find(1)));
});

// Home > Mascotas > Gatos
Breadcrumbs::for('mascotas.gatos', function ($trail) {
    $trail->parent('mascotas');
    $trail->push('Gatos', route('mascotas', Especie::find(2)));
});

// Home > Mascotas > Gatos > [Mascota]
Breadcrumbs::for('mascotas.nombre', function ($trail, Mascota $mascota) {
    $mascota->especie->id === 1 ? $trail->parent('mascotas.perros') : $trail->parent('mascotas.gatos');
    $trail->push($mascota->nombre, route('mascotas.show', $mascota));
});
/* ---------------------------------------------------------- */
// Home > Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > Administrar Mascotas
Breadcrumbs::for('dashboard.administrar-mascotas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Administar Mascotas', route('administrar-mascotas.index'));
});

// Home > Dashboard > Añadir nueva mascota
Breadcrumbs::for('dashboard.crear-mascota', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Añadir mascota', route('mascotas.create'));
});

// Home > Dashboard > Ver Peticiones
Breadcrumbs::for('dashboard.peticiones-adopcion', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Peticiones adopcion', route('peticiones-adopcion'));
});

// Home > Dashboard > Historial adopciones
Breadcrumbs::for('dashboard.historial-adopcion', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Historial adopcion', route('historial-adopciones'));
});

// Home > Dashboard > Ver Peticiones > [Familia]
Breadcrumbs::for('familia.peticiones', function ($trail, User $familia) {
    $trail->parent('dashboard.peticiones-adopcion');
    $trail->push($familia->name, route('familia-peticion.show', compact("familia")));
});

// Home > Dashboard > Historial adopciones > [Familia]
Breadcrumbs::for('familia.historial', function ($trail, User $familia) {
    $trail->parent('dashboard.historial-adopcion');
    $trail->push($familia->name, route('familia-historial.show', compact("familia")));
});
