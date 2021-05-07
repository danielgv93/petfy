@extends("layouts.master.master")

@section("title")
    Petfy
@endsection

@section("main")
    <div class="row justify-content-center">
        <h1>Bienvenido a Petfy</h1>
    </div>
    <div class="row justify-content-center">
        <h2>Elige que tipo de mascota vas a querer adoptar</h2>
    </div>
    <div class="row mt-5">
        <div class="col-4">
            <a href="{{route("mascotas", \App\Models\Especie::find(1))}}"><img style="width: 300px; pointer-events: none"
                                                            class="img-fluid mx-auto d-block"
                                                            src="{{url(asset("storage/web/perro.png"))}}"></a>
        </div>
        <div class="col-4 offset-4">
            <a href="{{route("mascotas", \App\Models\Especie::find(1))}}"><img style="width: 300px; pointer-events: none"
                                                            class="img-fluid mx-auto d-block"
                                                            src="{{url(asset("storage/web/gato.png"))}}"></a>
        </div>
    </div>
@endsection
