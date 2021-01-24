@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    <div class="row ">
        <div class="card m-1 bg-light border-secondary" style="width: 18rem;">
            <img class="card-img-top" src="{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
            <div class="card-body">
                <h3 class="card-title">{{$mascota->nombre}}</h3>
                <h5 class="card-title">Fecha Nacimiento: {{$mascota->fechaNacimiento}}</h5>
                <h5 class="card-title">Peso: {{$mascota->peso}} Kg</h5>
                <h5 class="card-title">Sexo: {{$mascota->sexo}}</h5>
                <h5 class="card-title">
                    {{--TODO: @if ($mascota instanceof \App\Models\Mascota)
                        Tamaño: {{$mascota->perro->tamano}}
                    @else
                        Pelo: {{$mascota->gato->pelo}}
                    @endif--}}
                </h5>
                <a href="{{ route('mascotas.editar' , $mascota) }}" class="btn btn-primary">Editar</a>
            </div>
        </div>
    </div>
@endsection
