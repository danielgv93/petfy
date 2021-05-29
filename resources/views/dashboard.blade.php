@extends("layouts.master.master")

@section("title")
    Menu de {{\Illuminate\Support\Facades\Auth::user()->name}}
@endsection
@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard") }}
    <div class="row">
        <table class="table">
            <thead class="thead-light">
            <tr>
                @if (auth()->user()->isRefugio())
                    <th scope="col">Gestión de mascotas</th>
                @endif
                <th scope="col">Gestión de perfil</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if (auth()->user()->isRefugio())
                    <td><a href="{{route("administrar-mascotas.index")}}">
                            <button class="btn btn-petfy" type="button"><i class="fas fa-tools"></i> Administra tus mascotas</button>
                        </a>
                    </td>
                @endif
                <td><a href="{{route("profile.show")}}">
                        <button class="btn btn-petfy" type="button"><i class="fas fa-user-cog"></i> Edita tu perfil</button>
                    </a></td>
            </tr>
            @if (auth()->user()->isRefugio())
                <tr>
                    <td><a href="{{route("mascotas.create")}}">
                            <button class="btn btn-petfy" type="button"><i class="fas fa-paw"></i> Añadir nueva mascota</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><a href="{{route("peticiones-adopcion")}}">
                            <button class="btn btn-petfy" type="button"><i class="fas fa-envelope-open-text"></i> Ver peticiones de adopción</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td><a href="{{route("historial-adopciones")}}">
                            <button class="btn btn-petfy" type="button"><i class="fas fa-history"></i> Ver historial de adopciones</button>
                        </a>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
