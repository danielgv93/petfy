<nav class="navbar navbar-expand-sm navbar-dark mb-2" style="background-color: rgb(148,193,31);">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route("welcome")}}">Petfy</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{ request()->routeIs('mascotas') ? ' active' : ''}}">
                    <a class="nav-link" href="{{route("mascotas")}}">Mascotas <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{ isset($especie_id) ?  ($especie_id == 1 ? ' active' : ''): ""}}">
                    <a class="nav-link " href="{{route("mascotas", 1)}}">Perros</a>
                </li>
                <li class="nav-item {{ isset($especie_id) && $especie_id == 2 ? ' active' : ''}}">
                    <a class="nav-link" href="{{route("mascotas", 2)}}">Gatos</a>
                </li>
            </ul>

        </div>
        @if (request()->routeIs('mascotas'))

            <form method="post" action="{{route("mascotas.busqueda")}}" class="input-group justify-content-center">
                @csrf
                <div class="form-outline">
                    <input type="hidden" name="especie" value="{{isset($especie_id) ? $especie_id : null}}">
                    <input type="search" name="busqueda" id="form1" class="form-control"
                           placeholder="Busca un{{isset($especie_id) ? ($especie_id == 1 ? " perro" : " gato" ) : "a mascota" }}"/>
                </div>
                <button class="btn btn-outline-success ml-2" type="submit" data-mdb-ripple-color="dark">Buscar</button>
            </form>
        @endif
        @if (\Illuminate\Support\Facades\Auth::check())
            <div class="dropdown custom-control-inline" style="margin-right: 7px">
                <img class="dropdown-toggle rounded-circle mr-2"
                     height="37"
                     width="37"
                     alt=""
                     loading="lazy" id="dropdownMenuButton" data-toggle="dropdown"
                     style="cursor: pointer"
                     src="{{asset("storage")}}/{{\Illuminate\Support\Facades\Auth::user()->profile_photo_path}}" alt="">
                <button class="btn bg-light dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route("dashboard")}}" title="Menu"><i class="fas fa-user mr-2"></i>Menú</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{route("logout")}}"
                           onclick="event.preventDefault(); this.closest('form').submit();" title="Logout"><i
                                class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                    </form>


                </div>
            </div>
        @else
            <a href="{{route("register")}}">
                <button class="btn bg-light mr-4" type="button">
                    Registro
                </button>
            </a>
            <a href="{{route("login")}}">
                <button class="btn bg-light" type="button">
                    Login
                </button>
            </a>
        @endif
    </div>
</nav>
