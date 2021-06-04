@extends("layouts.master.master")

@section("title")
    Petfy | Historial de adopciones
@endsection
@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard.historial-adopcion") }}
    <table class="table table-striped table-hover">
        <thead>
        <tr class="text-center">
            <th class="font-weight-bold">Familia</th>
            <th class="font-weight-bold">Mascota</th>
            <th class="font-weight-bold">Fecha</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($adopciones as $adopcion)
            <tr class="text-center">
                <td><a href="{{ route('familia-historial.show' , $adopcion["familia"]) }}">{{$adopcion["familia"]->name}}</a></td>
                <td><a href="{{ route('mascotas.show' , $adopcion["mascota"]) }}">{{$adopcion["mascota"]->nombre}} {!! $adopcion["mascota"]->especie->especie === "Perro" ? '<i class="fas fa-dog"></i>' : '<i class="fas fa-cat"></i>' !!}</a></td>
                <td>{{ $adopcion["mascota"]->fecha_adopcion }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
