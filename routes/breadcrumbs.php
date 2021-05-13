<?php

use App\Models\Especie;
use App\Models\Mascota;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

// Mascotas
Breadcrumbs::for('mascotas', function ($trail) {
    $trail->push('Mascotas', route('mascotas'));
});

// Mascotas > Perros
Breadcrumbs::for('mascotas.perros', function ($trail) {
    $trail->parent('mascotas');
    $trail->push('Perros', route('mascotas', Especie::find(1)));
});

// Mascotas > Gatos
Breadcrumbs::for('mascotas.gatos', function ($trail) {
    $trail->parent('mascotas');
    $trail->push('Gatos', route('mascotas', Especie::find(2)));
});

// Mascotas > Gatos > [Mascota]
Breadcrumbs::for('mascotas.nombre', function ($trail, Mascota $mascota) {
    $mascota->especie->id === 1 ? $trail->parent('mascotas.perros') : $trail->parent('mascotas.gatos');
    $trail->push($mascota->nombre, route('mascotas.show', $mascota));
});

// Mascotas > Dashboard
Breadcrumbs::for('dashboard', function ($trail) {
    $trail->parent('mascotas');
    $trail->push('Dashboard', route('dashboard'));
});

// Dashboard > Administrar Mascotas
Breadcrumbs::for('dashboard.administrar-mascotas', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Administar Mascotas', route('administrar-mascotas.index'));
});

// Dashboard > Añadir nueva mascota
Breadcrumbs::for('dashboard.crear-mascota', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Añadir mascota', route('mascotas.create'));
});

// Dashboard > Ver Peticiones
Breadcrumbs::for('dashboard.peticiones-adopcion', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Peticiones adopcion', route('peticiones-adopcion'));
});

// Dashboard > Añadir nueva mascota
Breadcrumbs::for('dashboard.historial-adopcion', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Historial adopcion', route('historial-adopciones'));
});
// Dashboard > Perfil
Breadcrumbs::for('dashboard.perfil', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Perfil', route('profile.show'));
});

