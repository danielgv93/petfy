@extends('layouts.master.master')

@section('title')
    Petfy | {{$familia->name}}
@endsection

@section("main")
    @php
        if (Illuminate\Support\Facades\Request::segment(2) === "historial-adopciones") {
            echo DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("familia.historial", $familia);
        } else {
            echo  DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("familia.peticiones", $familia);
        }
    @endphp

    <div class="row mb-5">
        @if ($familia->profile_photo_path)
            <div class="col-12 col-lg-6">
                <img style="border-radius: 24px" class="img-fluid mx-auto d-block" src="{{asset("storage")}}/{{ $familia->profile_photo_path }}" alt="Imagen de {{ $familia->nombre }}">
            </div>
        @endif

        <div class="col-12 col-lg-{{ $familia->profile_photo_path ? "6" : "12" }}">
            <h1>{{ $familia->name }}</h1>
            <div class="row ">
                <div class="col-3">
                    <h5>Correo:</h5>
                </div>
                <div class="col-9">
                    <p><a href="mailto:{{ $familia->email }}">{{ $familia->email }}</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <h5>Dirección:</h5>
                </div>
                <div class="col-9">
                    <p>{{ $familia->direccion }}</p>
                </div>
            </div>
            @if ($familia->sobre_mi !== null)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <h5>Sobre mí:</h5>
                    </div>
                    <div class="col-12 col-md-9">
                        <p>{{ $familia->sobre_mi }}</p>
                    </div>
                </div>
            @endif
            @if (count($familia->mascotas()->where("adoptado", true)->get()) > 0)
                <div class="row">
                    <div class="col-12 col-md-3">
                        <h5>Mascotas adoptadas:</h5>
                    </div>
                    <ul class="pl-3" style="list-style-type: none">
                        @foreach($familia->mascotas()->where("adoptado", true)->get() as $mascota)
                            <li class="pb-2">{!! $mascota->especie->especie === "Perro" ? '<i class="fas fa-dog"></i>' : '<i class="fas fa-cat"></i>' !!} {{ $mascota->nombre }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
@endsection
