@extends("layouts.master.master")

@section("title")
    Petfy
@endsection

@section("main")
    <h1>Bienvenido a Petfy</h1>
    <div class="row">
        <div class="col-12 col-md-6">
            <img class="img-fluid" id="refugioGif" src="{{url(asset("storage/web/Animal shelter.gif"))}}" alt="Animación de una ilustración de un refugio de mascotas">
        </div>
        <div class="col-12 col-md-6 justify-content-around d-flex flex-column">
            <div class="welcome__texto">
                <p>El lugar donde puedes encontrar a tu mascota</p>
            </div>
            <div class="welcome__texto">
                <p>¿A qué esperas? Entra a mirar y busca la que mejor se adapte a tus circustancias.</p>
            </div>
            <div class="text-center welcome__texto">
                <a href="{{ route("mascotas") }}" class="btn btn-petfy-inverse">ENTRAR</a>
            </div>
        </div>
    </div>
    <script>
        let refugio =  document.getElementById("refugioGif");
        refugio.src = refugio.getAttribute("src");
    </script>
@endsection
