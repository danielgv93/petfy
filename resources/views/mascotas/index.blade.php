@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    <div class="row justify-content-between">
        @foreach($mascotas as $mascota)
            <div class="card m-1 bg-light border-secondary" style="width: 18rem;">
                <img class="card-img-top" src="{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
                <div class="card-body">
                    <h5 class="card-title">{{$mascota->nombre}}</h5>
                    <a href="{{ route('mascotas.show' , $mascota) }}" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
