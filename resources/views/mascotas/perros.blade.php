@extends('layouts.master.master')

@section('title')
    Listado de Perros
@endsection

@section('main')
    <h1>Zona canina</h1>
    {{$perros->links("view.name")}}
    <div class="row justify-content-center">
        @foreach($perros as $perro)
            <a href="{{ route('mascotas.show' , $perro) }}">
                <div class="centrar card m-1 bg-light border-secondary" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage")}}/{{$perro->imagen}}"
                         alt="Imagen de {{$perro->nombre}}">
                    <div class="card-body text-center text-dark">
                        <h5 class="card-title">{{$perro->nombre}}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{$perros->links("view.name")}}
@endsection
