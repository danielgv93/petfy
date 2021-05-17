<!-- Site footer -->
<footer class="site-footer">
    <div class="container">

        <div class="row">
            <div class="col-6">
                <h6>Petfy</h6>
                <p>Refugios asociados:
                    @php
                    $refugios = \App\Models\Refugio::all();
                    for ($i = 0; $i < count($refugios); $i++) {
                        if ($i === count($refugios) - 1) {
                            echo ' y '. $refugios[$i]->name . ".";
                        } else {
                            echo $refugios[$i]->name. ", ";
                        }
                    }
                    @endphp</p>

            </div>
            <div class="col-3">
                <h6>Enlaces</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route("about-us") }}">Sobre Nosotros</a></li>
                    <li><a href="{{ route("mascotas") }}">Mascotas</a></li>
                </ul>
            </div>
            <div class="col-3">
                <h6>Redes Sociales</h6>
                <a title="Twitter" target="_blank" href="https://twitter.com/Petfy_Es"><i class="fab fa-twitter-square"></i></a>
                <a title="Telegram" target="_blank" href="https://t.me/petfy"><i class="fab fa-telegram"></i></a>
            </div>
        </div>
        <hr>
            <p class="copyright">Copyright &copy; 2021 Todos los derechos reservados por Petfy S.L.U.</p>
    </div>
</footer>
