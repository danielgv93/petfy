<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{url("/assets/bootstrap/css/bootstrap.min.css")}}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">
        <link rel="icon" type="image/vnd.microsoft.icon" href="{{asset("storage/web/favicon.png")}}">
        <link rel="stylesheet" href="{{url("/assets/font-awesome-4.7.0/css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{url("/assets/fontawesome-free-5.15.3-web/css/all.css")}}">
        <link rel="stylesheet" href="{{url("/assets/css/jquery-ui.css")}}">
        <link rel="stylesheet" href="{{url("/assets/css/master.css?v=").time()}}">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{url("/assets/js/jquery-ui.js")}}"></script>
        <script type="text/javascript" src="{{url("/assets/js/jquery-3.5.1.min.js")}}"></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
