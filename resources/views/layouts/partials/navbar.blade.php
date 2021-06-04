<nav class="navbar fixed-top navbar-expand-sm">
    <div class="container-fluid">
        <a id="logo" href="{{route("welcome")}}">
            <img class="mr-3" src="{{asset("storage/web/favicon.png")}}" alt="Logo de Petfy" height="37px">
        </a>
        <a class="logoText" title="Petfy" href="{{route("welcome")}}">Petfy</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ \Illuminate\Support\Facades\Request::segment(1) === "mascotas" &&
                                       empty(\Illuminate\Support\Facades\Request::segment(2)) ? ' menu-selected' : ""}}"
                       title="Mascotas" href="{{route("mascotas")}}">Mascotas <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Illuminate\Support\Facades\Request::segment(2) === "perros" ? ' menu-selected' : '' }}"
                       title="Perros" href="{{route("mascotas", \App\Models\Especie::find(1))}}">Perros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Illuminate\Support\Facades\Request::segment(2) === "gatos" ? ' menu-selected' : ''}}"
                       title="Gatos" href="{{route("mascotas", \App\Models\Especie::find(2))}}">Gatos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ \Illuminate\Support\Facades\Request::segment(1) === "sobre-nosotros" ? ' menu-selected' : ''}}"
                       title="Sobre nosotros" href="{{route("about-us")}}">Sobre nosotros</a>
                </li>
            </ul>

        </div>
        @if (\Illuminate\Support\Facades\Auth::check())
            <div class="dropdown custom-control-inline" style="margin-right: 7px">
                @if (Illuminate\Support\Facades\Auth::user()->profile_photo_path)
                    <img class="dropdown-toggle rounded-circle mr-2"
                         height="37"
                         width="37"
                         alt=""
                         loading="lazy" id="dropdownMenuButton" data-toggle="dropdown"
                         style="cursor: pointer"
                         src="{{asset("storage")}}/{{\Illuminate\Support\Facades\Auth::user()->profile_photo_path}}">
                @endif

                <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @if (auth()->user()->isRefugio())
                        <a class="dropdown-item" href="{{route("dashboard")}}" title="Menu"><i class="fas fa-tachometer-alt"></i> Menú</a>
                    @endif
                    <a class="dropdown-item" href="{{route("profile.show")}}" title="Perfil"><i class="fas fa-user"></i> Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{route("logout")}}"
                           onclick="event.preventDefault(); this.closest('form').submit();" title="Logout">
                            <i class="fa fa-sign-out-alt" aria-hidden="true"></i> Logout</a>
                    </form>

                </div>
            </div>
        @else
            <a href="{{route("register")}}">
                <button class="btn btn-petfy mr-4" type="button">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Registro
                </button>
            </a>
            <a href="{{route("login")}}">
                <button class="btn btn-petfy" type="button">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </a>
        @endif
    </div>
</nav>
