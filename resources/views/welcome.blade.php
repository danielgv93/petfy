<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PETFY</title>
    <link rel="stylesheet" href="{{url("/assets/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{url("/assets/css/master.css")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>
<body>
@include('layouts.partials.navbar')

<div class="container">
    <div class="row justify-content-center">
        <h1>Bienvenido a Petfy</h1>
    </div>
    <div class="row justify-content-center">
        <h2>Elige que tipo de mascota vas a querer adoptar</h2>
    </div>
    <div class="row mt-5">
        <div class="col-4">
            <a href="{{route("mascotas.perros")}}"><img style="width: 300px; pointer-events: none" class="img-fluid mx-auto d-block"
                            src="{{url(asset("storage/web/perro.png"))}}"></a>
        </div>
        <div class="col-4 offset-4">
            <a href="{{route("mascotas.gatos")}}"><img style="width: 300px; pointer-events: none" class="img-fluid mx-auto d-block"
                 src="{{url(asset("storage/web/gato.png"))}}"></a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{url("/assets/bootstrap/js/bootstrap.min.js")}}"></script>
</body>
</html>
