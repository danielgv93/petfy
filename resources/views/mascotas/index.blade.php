@extends('layouts.master.master')

@section('title')
    @if ($especie_id == 1)
        Perros
    @elseif($especie_id == 2)
        Gatos
    @else
        Petfy
    @endif

@endsection

@section('main')
    @if (session("mensaje"))
        <div class="alert-danger">{{session("mensaje")}}</div>
    @endif
    <h1>
        @if ($especie_id == 1)
            Zona canina
        @elseif($especie_id == 2)
            Zona felina
        @else
            Parque de mascotas
        @endif
    </h1>
    {{$mascotas->links("view.name")}}
    <div class="row justify-content-center">
        @foreach($mascotas as $mascota)
            <a href="{{ route('mascotas.show' , $mascota) }}">
                <div class="card m-1 bg-light border-secondary" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage")}}/{{$mascota->imagen}}"
                         alt="Imagen de {{$mascota->nombre}}">
                    <div class="card-body text-center text-dark">
                        <h5 class="tdn card-title">{{$mascota->nombre}}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{$mascotas->links("view.name")}}
@endsection
