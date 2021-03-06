@extends('layouts.master.master')

@section('title')
    {{$mascota->nombre}}
@endsection

@section('main')
    <div class="">
        <div class="row justify-content-center">
            <div class="col-6 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="img-square-wrapper mt-3">
                            <img class="img-fluid mx-auto d-block rounded" src="{{asset("storage")}}/{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{$mascota->nombre}}</h3>
                            <h5 class="card-title text-center">Fecha Nacimiento: {{$mascota->fechaNacimiento}}</h5>
                            <h5 class="card-title text-center">Refugio: <a href="">{{$mascota->refugio->name}}</a></h5>
                            <h5 class="card-title text-center">Peso: {{$mascota->peso}} Kg</h5>
                            <h5 class="card-title text-center">Sexo: {{$mascota->sexo}}</h5>
                            @if ($mascota->raza !== null)
                                <h5 class="card-title text-center">Raza: {{$mascota->raza}}</h5>
                            @endif
                            @if ($mascota->color !== null)
                                <h5 class="card-title text-center">Color: {{$mascota->color}}</h5>
                            @endif
                            @if ($mascota->pelaje !== null)
                                <h5 class="card-title text-center">Pelaje: {{$mascota->pelaje}}</h5>
                            @endif
                            @if ($mascota->tamano !== null)
                                <h5 class="card-title text-center">Tamaño: {{$mascota->tamano}}</h5>
                            @endif
                            @if ($mascota->descripcion !== null)
                                <h5 class="card-title text-center">Descripción: </h5>
                                <p class="text-justify">{{$mascota->descripcion}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{route("mascotas.adoptar")}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$mascota->id}}">
                            <input type="submit" style="width: 50%" href="{{--TODO: ADOPTAR--}}" class="btn btn-primary adoptar-btn" value="Adoptar">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
