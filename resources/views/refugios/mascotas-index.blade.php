@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    <h1>Estas son tus mascotas</h1>
    {{$mascotas->links("view.name")}}
    <div class="row">
        @foreach($mascotas as $mascota)
            <div class="centrar card m-1 bg-light border-secondary" style="width: 18rem;">
                <img class="card-img-top" src="{{asset("storage")}}/{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
                <div class="card-body">
                    <h5 class="card-title">{{$mascota->nombre}}</h5>
                    <a href="{{ route('administrar-mascotas.edit' , $mascota) }}" class="btn btn-primary">Editar</a>
                </div>
            </div>
        @endforeach
    </div>
    {{$mascotas->links("view.name")}}
@endsection
