@extends("layouts.master.master")

@section("title")
    Menu de {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection
@section("main")
    <div class="row">
        <table class="table">
            <thead class="thead-light">
            <tr>
                @if (auth()->user()->rol->role_name === "refugio")
                    <th scope="col">Gestión de mascotas</th>
                @endif
                <th scope="col">Gestión de perfil</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if (auth()->user()->rol->role_name === "refugio")
                    <td><a href="{{route("administrar-mascotas.index")}}">
                            <button class="btn btn-dark" type="button">Administra tus mascotas</button>
                        </a>
                    </td>
                @endif
                <td><a href="{{route("profile.show")}}">
                        <button class="btn btn-dark" type="button">Edita tu perfil</button>
                    </a></td>
            </tr>
            @if (auth()->user()->rol->role_name === "refugio")
                <tr>
                    <td><a href="{{route("mascotas.create")}}">
                            <button class="btn btn-dark" type="button">Añadir nueva mascota</button>
                        </a>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
