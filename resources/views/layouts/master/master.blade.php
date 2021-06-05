<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{url("/assets/bootstrap/css/bootstrap.min.css")}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset("storage/web/favicon.png")}}">
    <link rel="stylesheet" href="{{url("/assets/fontawesome-free-5.15.3-web/css/all.css")}}">
    <script type="text/javascript" src="{{url("/assets/js/jquery-3.5.1.min.js")}}"></script>
    <script type="text/javascript" src="{{url("/assets/js/jquery-ui.js")}}"></script>
    <link rel="stylesheet" href="{{url("/assets/css/jquery-ui.css")}}">
    <link rel="stylesheet" href="{{url("/assets/css/master.css?v=").time()}}">
</head>
<body>
<div id="page-container" class="pt-3 pt-md-0" {{--{!! in_array( \Illuminate\Support\Facades\Route::currentRouteName(), ["mascotas.create", "administrar-mascotas.edit"]) ? 'style="min-height: 115vh"' : '' !!}--}}>
    @include('layouts.partials.navbar')
    <div class="container">
        @yield('main')
    </div>
    @include("layouts.partials.footer")
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{url("/assets/bootstrap/js/bootstrap.min.js")}}"></script>
<script src="{{url("/assets/js/master.js")}}"></script>
<script src="{{url("/js/app.js")}}"></script>
@yield("scripts")
</body>
</html>
