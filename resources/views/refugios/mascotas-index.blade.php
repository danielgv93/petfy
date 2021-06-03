@extends('layouts.master.master')

@section('title')
    Petfy | Listado Mascotas
@endsection

@section('main')
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.administrar-mascotas") }}
    <h1>Estas son tus mascotas</h1>

    <div class="row justify-content-center">
        {{$mascotas->links("view.name")}}
        @foreach($mascotas as $mascota)
            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                <div class="tarjeta-mascota">
                    <div class="tarjeta-mascota__image">
                        <img class="" src="{{asset("storage")}}/{{$mascota->imagen}}"
                             alt="Imagen de {{$mascota->nombre}}">
                        <div class="tarjeta-mascota__overlay">
                        </div>
                    </div>
                    <div class="tarjeta-mascota__text">
                        <div class="tarjeta-mascota__badges d-flex">
                            <div class="tarjeta-mascota__badge"
                                 style="background: rgba({{ $mascota->sexo === "Macho" ? "71, 158, 255, 0.8" : "255, 85, 100, 0.8"}})">
                                <p>{{ $mascota->sexo }} {!! $mascota->sexo === "Macho" ? '<i class="fas fa-mars"></i>' : '<i class="fas fa-venus"></i>' !!}</p>
                            </div>
                            <div class="tarjeta-mascota__badge">
                                {{$mascota->getEdadCorta()}}
                            </div>

                        </div>
                        <h3>{{$mascota->nombre}} {!! $mascota->especie->especie === "Perro" ? '<i class="fas fa-dog"></i>' : '<i class="fas fa-cat"></i>' !!}  </h3>
                        <div class="tarjeta-mascota__refugio">
                            <div class="form-inline justify-content-around">
                                <a href="{{ route('administrar-mascotas.edit' , $mascota) }}"
                                   class="btn btn-petfy-inverse">Editar</a>
                                <form id="{{ $mascota->id }}" action="{{ route('mascotas.destroy' , $mascota) }}" method="post">
                                    @csrf
                                    @method("delete")
                                    <input type="hidden" value="{{ $mascota->id }}">
                                    <input type="button" onclick="borrarMascota('{{ $mascota->nombre }}', '{{ $mascota->id }}')" class="btn btn-petfy-inverse" value="Borrar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$mascotas->links("view.name")}}
    </div>

@endsection
