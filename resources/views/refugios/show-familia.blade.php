@extends('layouts.master.master')

@section('title')
    {{$familia->name}}
@endsection

@section('main')
    @php
        if (Illuminate\Support\Facades\Request::segment(2) === "historial-adopciones") {
            echo DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("familia.historial", $familia);
        } else {
            echo  DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("familia.peticiones", $familia);
        }
    @endphp
    <div class="">
        <div class="row justify-content-center">
            <div class="col-6 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        @if ($familia->imagen)
                            <div class="img-square-wrapper mt-3">
                                <img class="img-fluid mx-auto d-block rounded" src="{{asset("storage")}}/{{$familia->imagen}}" alt="Imagen de {{$familia->nombre}}">
                            </div>
                        @endif

                        <div class="card-body">
                            <h3 class="card-title text-center">{{ $familia->name }}</h3>
                            <h5 class="card-title text-center">Correo: {{ $familia->email }}</h5>
                            <h5 class="card-title text-center">Direccion: {{ $familia->direccion }}</h5>
                            @if ($familia->ciudad)
                                <h5 class="card-title text-center">Ciudad: {{ $familia->ciudad }}</h5>
                            @endif
                            @if ($familia->descripcion)
                                <h5 class="card-title text-center">Sobre mi: </h5>
                                <p class="text-justify">{{$mascota->descripcion}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
