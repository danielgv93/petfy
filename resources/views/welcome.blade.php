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
        <div class="col-12 col-md-6">
            <div class="wellcome__container">
                <div class="">
                    <div class="">
                        <p>El lugar donde puedes encontrar a tu mascota</p>
                    </div>
                </div>
                <div class="">
                    <div class="">
                        <p>¿A qué esperas? Entra a mirar y busca la que mejor se adapte a tus circustancias.</p>
                    </div>
                </div>
                <div class="">
                    <a href="{{ route("mascotas") }}" class="btn btn-petfy-inverse">ENTRAR</a>
                </div>

            </div>
        </div>


    </div>
    <script>
        let refugio =  document.getElementById("refugioGif");
        refugio.src = refugio.getAttribute("src");
    </script>
@endsection
