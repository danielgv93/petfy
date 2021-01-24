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
            <li class="nav-item">
                <a class="nav-link " href="#">Perros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Gatos</a>
            </li>
        </ul>

    </div>
    <div class="dropdown">
        <button class="btn bg-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Perfil
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="perfil.php" title="perfil"><i class="fas fa-user mr-2"></i>Perfil</a>
            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt mr-2"></i>Logout</a>
        </div>
    </div>
</nav>
