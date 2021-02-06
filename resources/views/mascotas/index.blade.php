@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    <h1>Parque de mascotas</h1>
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
