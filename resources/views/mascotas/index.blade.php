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



    <div class="row">
        <div class="col-3">
            @include("layouts.partials.filtro")
        </div>
        <div class="col-9">
            <div class="row">
                {{$mascotas->links("view.name")}}
            </div>
            @if(count($mascotas))
            <div class="row">
                @foreach($mascotas as $mascota)
                    <div class="col-10 col-md-6 col-lg-5 col-xl-4">
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
                                        <p>{{ $mascota->sexo }} {!! $mascota->sexo === "Macho" ? '<i class="fas fa-mars"></i>' : '<i class="fas fa-venus"></i>' !!}</p>
                                    </div>
                                    <div class="tarjeta-mascota__badge">
                                        <p>{{$mascota->getEdadCorta()}}</p>
                                    </div>

                                </div>
                                <h3>{{$mascota->nombre}} {!! $mascota->especie->especie === "Perro" ? '<i class="fas fa-dog"></i>' : '<i class="fas fa-cat"></i>' !!}  </h3>
                                <div class="tarjeta-mascota__refugio">
                                    <i class="fas fa-map-marker-alt"></i> {{ $mascota->refugio->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
                @else
                <div class="row justify-content-center">
                    <h2 class="mt-5">No hay mascotas disponibles</h2>
                </div>
                @endif
                {{$mascotas->links("view.name")}}


        </div>

    </div>

@endsection
