@extends('layouts.master.master')

@section('title')
    Listado de Perros
@endsection

@section('main')
    <h1>Perros</h1>
    <div class="row">
        @foreach($perros as $perro)
            <div class="centrar card m-1 bg-light border-secondary" style="width: 18rem;">
                <img class="card-img-top" src="{{$perro->imagen}}" alt="Imagen de {{$perro->nombre}}">
                <div class="card-body">
                    <h5 class="card-title">{{$perro->nombre}}</h5>
                    <a href="{{ route('mascotas.show' , $perro) }}" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
