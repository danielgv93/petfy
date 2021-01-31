@extends("layouts.master.master")

@section("title")
    {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection
@section("main")
    <div class="row">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">Gestión de mascotas</th>
                <th scope="col">Gestión de perfil</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a href="{{route("administrar-mascotas.index")}}">
                        <button class="btn btn-primary" type="button">Administra tus mascotas</button>
                    </a></td>
                <td><a href="{{route("profile.show")}}">
                        <button class="btn btn-primary" type="button">Edita tu perfil</button>
                    </a></td>
            </tr>
            <tr>
                <td><a href="">
                        <button class="btn btn-primary" type="button">Añadir nueva mascota</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
