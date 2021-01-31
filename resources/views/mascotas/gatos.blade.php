@extends('layouts.master.master')

@section('title')
    Listado de Perros
@endsection

@section('main')
    <h1>Gatos</h1>
    <div class="row">
        @foreach($gatos as $gato)
            <div class="centrar card m-1 bg-light border-secondary" style="width: 18rem;">
                <img class="card-img-top" src="{{$gato->imagen}}" alt="Imagen de {{$gato->nombre}}">
                <div class="card-body">
                    <h5 class="card-title">{{$gato->nombre}}</h5>
                    <a href="{{ route('mascotas.show' , $gato) }}" class="btn btn-primary">Más información</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
