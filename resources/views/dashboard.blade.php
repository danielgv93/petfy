@extends("layouts.master.master")

@section("title")
    Petfy | Dashboard
@endsection

@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("dashboard") }}
    <div class="row">
        <div class="col-12 col-lg-6">
            <a class="dashboard__enlace" href="{{ route("administrar-mascotas.index") }}">
                <div class="row mt-5 mb-5 justify-content-center">
                    <div class="btn btn-petfy dashboard__boton">
                        <div class="row">
                            <div class="col-2 col-md-3">
                                <i class="fas fa-tools fa-lg"></i>
                            </div>
                            <div class="col-10 col-md-9 dashboard__boton__texto">
                                Administra tus mascotas
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <a class="dashboard__enlace" href="{{ route("mascotas.create") }}">
                <div class="row justify-content-center">
                    <div class="btn btn-petfy dashboard__boton">
                        <div class="row">
                            <div class="col-2 col-md-3">
                                <i class="fas fa-paw fa-lg"></i>
                            </div>
                            <div class="col-10 col-md-9 dashboard__boton__texto">
                                Añadir nueva mascota
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-lg-6">
            <a class="dashboard__enlace" href="{{ route("peticiones-adopcion") }}">
                <div class="row mt-5 mb-5 justify-content-center">
                    <div class="btn btn-petfy dashboard__boton">
                        <div class="row">
                            <div class="col-2 col-md-3">
                                <i class="fas fa-envelope-open-text fa-lg"></i>
                            </div>
                            <div class="col-10 col-md-9 dashboard__boton__texto">
                                Ver peticiones de adopción
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="dashboard__enlace" href="{{ route("historial-adopciones") }}">
                <div class="row justify-content-center">
                    <div class="btn btn-petfy dashboard__boton">
                        <div class="row">
                            <div class="col-2 col-md-3">
                                <i class="fas fa-history fa-lg"></i>
                            </div>
                            <div class="col-10 col-md-9 dashboard__boton__texto">
                                Ver historial de adopciones
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
