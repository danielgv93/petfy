@extends('layouts.master.master')

@section('title')
    Petfy | Añadir mascota
@endsection

@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.crear-mascota") }}
    <form class="col" action="{{route("mascotas.store")}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId"
                       placeholder="Introduzca un nombre" required>
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
            <div class="col form-group">
                <label for="especie">Tipo de mascota:</label>
                <select class="form-control" name="especie" id="especie">
                    @foreach(\App\Models\Especie::all() as $especie)
                        <option value="{{$especie->id}}">{{$especie->especie}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
                <label for="fechaNacimiento">Fecha Nacimiento:</label>
                <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento"
                       aria-describedby="helpId" required>
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
            <div class="col form-group">
                <label for="sexo">Sexo:</label>
                <select class="form-control" name="sexo" id="sexo">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
            <div class="col form-group">
                <label for="tamano">Tamaño:</label>
                <select class="form-control" name="tamano" id="tamano">
                    <option value="pequeño">Pequeño</option>
                    <option value="mediano">Mediano</option>
                    <option value="grande">Grande</option>
                </select>
                <small id="helpId" class="form-text text-muted text-danger">*Campo obligatorio</small>
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
                <label for="raza">Raza:</label>
                <input type="text" class="form-control" name="raza" id="raza" aria-describedby="helpId"
                       placeholder="Introduzca una raza">
            </div>
            <div class="col form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" name="color" id="color" aria-describedby="helpId"
                       placeholder="Introduzca un color">
            </div>
            <div class="col form-group">
                <label for="pelaje">Pelaje:</label>
                <select class="form-control" name="pelaje" id="pelaje">
                    <option value="Largo">Largo</option>
                    <option value="Corto">Corto</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col form-group">
                <label for="urgente">¿Urgente?:</label>
                <select class="form-control" name="urgente" id="urgente">
                    <option>Si</option>
                    <option selected>No</option>
                </select>
            </div>
            <div class="col form-group">
                <label for="sociable">¿Sociable?:</label>
                <select class="form-control" name="sociable" id="sociable">
                    <option>-</option>
                    <option>Si</option>
                    <option>No</option>
                </select>
            </div>
            <div class="col form-group">
                <label for="esterilizado">¿Esterilizado?:</label>
                <select class="form-control" name="esterilizado" id="esterilizado">
                    <option>-</option>
                    <option>Si</option>
                    <option>No</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col form-group">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control-file" name="imagen" id="imagen"
                       placeholder="Imagen de la mascota"
                       aria-describedby="fileHelpId" required>
            </div>
        </div>
        <button type="submit" name="submit" class="row btn btn-petfy-inverse">Añadir</button>
    </form>
@endsection
