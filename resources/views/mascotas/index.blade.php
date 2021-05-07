@extends('layouts.master.master')

@section('title')
    @if ($especie->slug == "perros")
        Perros
    @elseif($especie->slug == "gatos")
        Gatos
    @else
        Petfy
    @endif

@endsection

@section('main')
    @include("layouts.partials.mapa")
    @if (session("mensaje"))
        <div class="alert-danger">{{session("mensaje")}}</div>
    @endif
    <h1>
        @if ($especie->slug == "perros")
            Zona canina
        @elseif($especie->slug == "gatos")
            Zona felina
        @else
            Parque de mascotas
        @endif
    </h1>
    {{$mascotas->links("view.name")}}

    <div class="row justify-content-center">
        @include("layouts.partials.filtro")
        @foreach($mascotas as $mascota)
            @if(!$mascota->adoptado)
            <a href="{{ route('mascotas.show' , $mascota) }}">
                <div class="card m-1 bg-light border-secondary" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage")}}/{{$mascota->imagen}}"
                         alt="Imagen de {{$mascota->nombre}}">
                    <div class="card-body text-center text-dark">
                        <h5 class="tdn card-title">{{$mascota->nombre}}</h5>
                    </div>
                </div>
            </a>
            @endif
        @endforeach
    </div>
    {{$mascotas->links("view.name")}}
@endsection
