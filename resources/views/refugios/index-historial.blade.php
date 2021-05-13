@extends("layouts.master.master")

@section("title")
    Historial de adopciones
@endsection
@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.historial-adopcion") }}
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="font-weight-bold">Familia</th>
            <th class="font-weight-bold">Mascota</th>
            <th class="font-weight-bold">Refugio</th>
            <th class="font-weight-bold">Fecha</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($adopciones as $adopcion)
            <tr>
                <td>{{$adopcion["familia"]->name}}</td>
                <td><a href="{{ route('mascotas.show' , $adopcion["mascota"]) }}">{{$adopcion["mascota"]->nombre}}</a></td>
                <td><a href="{{ route('refugio.show' , $adopcion["mascota"]->refugio) }}">{{$adopcion["mascota"]->refugio->name}}</a></td>
                <td>{{ $adopcion["mascota"]->fecha_adopcion }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
