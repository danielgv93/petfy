<nav class="navbar navbar-expand-sm navbar-dark" style="background-color: #0c4128;">
    <a class="navbar-brand" href="{{route("welcome")}}">Petfy</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item {{ request()->routeIs('mascotas')? ' active' : ''}}">
                <a class="nav-link" href="{{route("mascotas")}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{ request()->routeIs('mascotas.perros')? ' active' : ''}}">
                <a class="nav-link " href="{{route("mascotas.perros")}}">Perros</a>
            </li>
            <li class="nav-item {{ request()->routeIs('mascotas.gatos')? ' active' : ''}}">
                <a class="nav-link" href="{{route("mascotas.gatos")}}">Gatos</a>
            </li>
        </ul>

    </div>
    @if (\Illuminate\Support\Facades\Auth::check())
        <div class="dropdown">
            <button class="btn bg-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                Hola, {{\Illuminate\Support\Facades\Auth::user()->name}}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route("dashboard")}}" title="Menu"><i class="fas fa-user mr-2"></i>Menú</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{route("logout")}}" onclick="event.preventDefault(); this.closest('form').submit();" title="Logout"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
                </form>


            </div>
        </div>
    @else
        <a href="{{route("login")}}"><button class="btn bg-light" type="button">
            Login
        </button></a>
    @endif
</nav>
