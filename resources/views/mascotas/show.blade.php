@extends('layouts.master.master')

@section('title')
    {{$mascota->nombre}}
@endsection

@section('main')
        <div class="bg-light border-secondary" style="width: 18rem;">
            <img  class="card-img-top" src="{{asset("storage")}}/{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
            <div class="card-body">
                <h3 class="card-title">{{$mascota->nombre}}</h3>
                <h5 class="card-title">Fecha Nacimiento: {{$mascota->fechaNacimiento}}</h5>
                <h5 class="card-title">Peso: {{$mascota->peso}} Kg</h5>
                <h5 class="card-title">Sexo: {{$mascota->sexo}}</h5>
                @if ($mascota->raza !== null)
                    <h5 class="card-title">Raza: {{$mascota->raza}}</h5>
                @endif
                @if ($mascota->color !== null)
                    <h5 class="card-title">Color: {{$mascota->color}}</h5>
                @endif
                @if ($mascota->pelaje !== null)
                    <h5 class="card-title">Pelaje: {{$mascota->pelaje}}</h5>
                @endif
                @if ($mascota->tamano !== null)
                    <h5 class="card-title">Tamaño: {{$mascota->tamano}}</h5>
                @endif
                @if ($mascota->descripcion !== null)
                    <h5 class="card-title">Descripción: </h5>
                    <p>{{$mascota->descripcion}}</p>
                @endif
                <a href="{{--TODO: ADOPTAR--}}" class="btn btn-primary">Adoptar</a>
            </div>
        </div>
@endsection
