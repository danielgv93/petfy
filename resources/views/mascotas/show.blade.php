@extends('layouts.master.master')

@section('title')
    {{$mascota->nombre}}
@endsection
@section('main')
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("mascotas.nombre", $mascota) }}
    <div class="row mb-5">
        <div class="col-6">
            <img style="border-radius: 24px" class="img-fluid mx-auto d-block" src="{{asset("storage")}}/{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
        </div>
        <div class="col-6">
            @if ($mascota->urgente)
                <h6 class="card-title text-center">*Urge adopción*</h6>
            @endif
            <h1>{{ $mascota->nombre }}</h1>
            <div class="row ">
                <div class="col-3">
                    <h5>Edad:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->getEdadLarga() }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <h5>Refugio:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->refugio->name }}</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <h5>Sexo:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->sexo }}</h5>
                </div>
            </div>
            @if ($mascota->tamano !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Tamaño:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->tamano }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->raza !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Raza:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->raza }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->color !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Color:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->color }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->pelaje !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Pelaje:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->pelaje }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->sociable !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Sociable:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->sociable ? "Si" : "No" }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->esterilizado !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Esterilizado:</h5>
                </div>
                <div class="col-9">
                    <h5>{{ $mascota->esterilizado ? "Si" : "No" }}</h5>
                </div>
            </div>
            @endif
            @if ($mascota->descripcion !== null)
            <div class="row">
                <div class="col-3">
                    <h5>Descripción:</h5>
                </div>
                <div class="col-9">
                    <p>{{ $mascota->descripcion }}</p>
                </div>
            </div>
            @endif

            <div class="row justify-content-end ">
                <a href="{{route("refugio.show", $mascota->refugio)}}"><button class="btn btn-petfy mr-3"><i class="fas fa-map-marker-alt"></i> Info del refugio</button></a>
                <form id="{{ $mascota->id }}" action="{{route("mascotas.adoptar")}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$mascota->id}}">
                    <button type="button" onclick="enviarSolicitud('{{ $mascota->nombre }}', '{{ $mascota->id }}')" class="btn btn-petfy-inverse"><i class="fas fa-envelope-open-text"></i> Adoptar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
