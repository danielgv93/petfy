@extends('layouts.master.master')

@section('title')
    @if ($especie->slug == "perros")
        Perros
    @elseif($especie->slug == "gatos")
        Gatos
    @else
        Petfy
    @endif

@endsection

@section('main')
    @php
        use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
        use Illuminate\Support\Facades\Request;
        $procedencia = Request::segment(2);
        if (!$procedencia) {
            echo Breadcrumbs::render("mascotas");
        } else {
            echo $procedencia === "perros" ? Breadcrumbs::render("mascotas.perros") : Breadcrumbs::render("mascotas.gatos");
        }
    @endphp

    @if (session("mensaje"))
        <div class="alert-danger">{{session("mensaje")}}</div>
    @endif
    <h1>
        @if ($especie->slug == "perros")
            Zona canina
        @elseif($especie->slug == "gatos")
            Zona felina
        @else
            Parque de mascotas
        @endif
    </h1>
    {{$mascotas->links("view.name")}}

    <div class="row justify-content-center">
        @include("layouts.partials.filtro")
        @if(count($mascotas))
            @foreach($mascotas as $mascota)
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <a class="tarjeta-mascota" href="{{ route('mascotas.show' , $mascota) }}">
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
                                    {{ $mascota->sexo }} {!!  $mascota->sexo === "Macho" ? '<i class="fa fa-mars" aria-hidden="true"></i>' : '<i class="fa fa-venus" aria-hidden="true"></i>' !!}
                                </div>
                                <div class="tarjeta-mascota__badge">
                                    {{$mascota->getEdadCorta()}}
                                </div>

                            </div>
                            <h3>{{$mascota->nombre}}</h3>
                            <div>
                                <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $mascota->refugio->name }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <h2 class="mt-5">No hay mascotas disponibles</h2>
        @endif
    </div>
    {{$mascotas->links("view.name")}}
@endsection
