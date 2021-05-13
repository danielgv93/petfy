@extends('layouts.master.master')

@section('title')
    Listado Mascotas
@endsection

@section('main')
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.administrar-mascotas") }}
    <h1>Estas son tus mascotas</h1>
    {{$mascotas->links("view.name")}}
    <div class="row justify-content-center">
        @foreach($mascotas as $mascota)
            <div class="card m-1 bg-light border-secondary" style="width: 18rem;">
                <img class="card-img-top" src="{{asset("storage")}}/{{$mascota->imagen}}"
                     alt="Imagen de {{$mascota->nombre}}">
                <div class="card-body inlin">
                    <h5 class="card-title">{{$mascota->nombre}}</h5>
                    <div class="form-inline justify-content-around">
                        <a href="{{ route('administrar-mascotas.edit' , $mascota) }}"
                           class="btn btn-primary">Editar</a>
                        <form action="{{ route('mascotas.destroy' , $mascota) }}" method="post">
                            @csrf
                            @method("delete")
                            <input type="submit" class="btn btn-primary" value="Borrar">
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    {{$mascotas->links("view.name")}}
@endsection
