@extends('layouts.master.master')

@section('title')
    Listado de Perros
@endsection

@section('main')
    <h1>Zona felina</h1>
    {{$gatos->links("view.name")}}
    <div class="row justify-content-center">
        @foreach($gatos as $gato)
            <a href="{{ route('mascotas.show' , $gato) }}">
                <div class="centrar card m-1 bg-light border-secondary" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset("storage")}}/{{$gato->imagen}}"
                         alt="Imagen de {{$gato->nombre}}">
                    <div class="card-body">
                        <h5 class="card-title text-center text-dark text-decoration-none">{{$gato->nombre}}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{$gatos->links("view.name")}}
@endsection
