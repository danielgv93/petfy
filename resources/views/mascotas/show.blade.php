@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    <div class="row">
        <div class="bg-light border-secondary" style="width: 18rem;">
            <img class="card-img-top" src="{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
            <div class="card-body">
                <h3 class="card-title">{{$mascota->nombre}}</h3>
                <h5 class="card-title">Fecha Nacimiento: {{$mascota->fechaNacimiento}}</h5>
                <h5 class="card-title">Peso: {{$mascota->peso}} Kg</h5>
                <h5 class="card-title">Sexo: {{$mascota->sexo}}</h5>
                @if ($mascota->especie === 1)
                    <h5 class="card-title">Sexo: {{$mascota->tamano}}</h5>
                @endif
                <a href="{{--TODO: ADOPTAR--}}" class="btn btn-primary">Adoptar</a>
            </div>
        </div>
    </div>
@endsection
