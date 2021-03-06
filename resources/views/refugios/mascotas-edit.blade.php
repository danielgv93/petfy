@extends('layouts.master.master')

@section('title')
    Editar datos de {{$mascota->nombre}}
@endsection
@section('main')
    <div class="row">
        <div class="col-4">
            <h3>{{$mascota->nombre}}</h3>
            <img class="card-img" src="{{asset("storage")}}/{{$mascota->imagen}}" alt="Imagen de {{$mascota->nombre}}">
        </div>
        <form class="col-8" action="{{route("administrar-mascotas.update", $mascota)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="row form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                       placeholder="Introduzca un nombre" value="{{$mascota->nombre}}">
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label for="fechaNacimiento">Fecha Nacimiento:</label>
                    <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" aria-describedby="helpId"
                           value="{{$mascota->fechaNacimiento}}">
                    <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
                </div>
                <div class="col form-group">
                    <label for="peso">Peso:</label>
                    <input type="number" class="form-control" name="peso" id="peso" aria-describedby="helpId"
                           placeholder="Introduzca un peso" min="0" value="{{$mascota->peso}}">
                    <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
                </div>
                <div class="col form-group">
                    <label for="sexo">Sexo:</label>
                    <select class="form-control" name="sexo" id="sexo">
                        <option value="Macho" >Macho</option>
                        <option value="Hembra"{{$mascota->sexo == "Hembra" ? "selected":""}}>Hembra</option>
                    </select>
                    <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
                </div>
            </div>
            <div class="row">
                <div class="col form-group">
                    <label for="raza">Raza:</label>
                    <input type="text" class="form-control" name="raza" id="raza" aria-describedby="helpId"
                           placeholder="Introduzca una raza" value="{{$mascota->raza}}">
                </div>
                <div class="col form-group">
                    <label for="color">Color:</label>
                    <input type="text" class="form-control" name="color" id="color" aria-describedby="helpId"
                           placeholder="Introduzca un color" value="{{$mascota->color}}">
                </div>
                <div class="col form-group">
                    <label for="pelaje">Pelaje:</label>
                    <select class="form-control" name="pelaje" id="pelaje">
                        <option value="Largo">Largo</option>
                        <option value="Corto">Corto</option>
                    </select>
                </div>
            </div>

            <div class="row form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3">{{$mascota->descripcion}}</textarea>
            </div>
            <div class="row form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control-file" name="imagen" id="imagen"
                       placeholder="Imagen de la mascota"
                       aria-describedby="fileHelpId">
            </div>
            <button type="submit" name="submit" class="row btn btn-primary">Editar</button>
        </form>

    </div>
@endsection
