@extends("layouts.master.master")

@section("title")
    Petfy | Peticiones de adopcion
@endsection
@section("main")
    @if (session("mensaje"))
        <div class="alert-danger">{{session("mensaje")}}</div>
    @endif
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.peticiones-adopcion") }}
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="font-weight-bold">Familia</th>
            <th class="font-weight-bold">Mascota</th>
            <th class="font-weight-bold"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($familias as $familia)
            @foreach($familia->mascotas as $mascota)
                @if($mascota->refugio->id == $refugio->id && !$mascota->adoptado)
                    <tr>
                        <td><a href="{{ route('familia-peticion.show' , $familia) }}">{{$familia->name}}</a></td>
                        <td><a href="{{ route('mascotas.show' , $mascota) }}">{{$mascota->nombre}}</a></td>
                        <td><a href="#" onclick="aceptarSolicitud('{{ $mascota->nombre }}', '{{ $familia->name }}', '{{asset("storage")}}/{{$mascota->imagen}}')">
                                <button class="btn btn-dark">Aceptar Adopción</button>
                            </a></td>
                    </tr>
                @endif
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
