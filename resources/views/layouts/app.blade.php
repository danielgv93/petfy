<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Petfy | Edita tu perfil</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{url("/assets/bootstrap/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{url("/assets/css/master.css")}}">
        <link rel="stylesheet" href="{{url("/assets/fontawesome-free-5.15.3-web/css/all.css")}}">
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset("storage/web/favicon.png")}}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
    <div id="page-container" class="pt-3 pt-md-0">
        <div class="container">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @include("layouts.partials.footer")
    </div>
        @stack('modals')

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
                integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
        <script src="{{url("/assets/bootstrap/js/bootstrap.min.js")}}"></script>
        @livewireScripts
    </body>
</html>
