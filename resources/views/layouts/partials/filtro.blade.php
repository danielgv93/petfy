<div class="col-12 mb-5 filtro">
    <div id="filtro-container">
        <div class="row">
            <div class="col">
                <div class="form-outline mr-3">
                    <input type="search" name="busqueda" id="busqueda" class="form-control"
                           placeholder="Busca una mascota"/>
                </div>
            </div>
        </div>
    <form id="filtro" action="{{route("mascotas", \Illuminate\Support\Facades\Request::segment(2))}}">

        <hr>
        <div class="row">
            <div class="col">
                <h3>Sexo</h3>
                <label for="macho" class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="macho"
                           value="Macho" {{ isset($_GET["sexo"]) && $_GET["sexo"] == "Macho" ? "checked" : "" }}>
                    <span class="form-check-label">Macho</span>
                </label>
                <label for="hembra" class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="hembra"
                           value="Hembra" {{ isset($_GET["sexo"]) && $_GET["sexo"] == "Hembra" ? "checked" : "" }}>
                    <span class="form-check-label">Hembra</span>
                </label>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h3>Tamaño</h3>
                <label for="grande" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="grande"
                           value="Grande" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Grande" ? "checked" : "" }}>
                    <span class="form-check-label">Grande</span>
                </label>
                <label for="mediano" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="mediano"
                           value="Mediano" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Mediano" ? "checked" : "" }}>
                    <span class="form-check-label">Mediano</span>
                </label>
                <label for="pequeno" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="pequeno"
                           value="Pequeño" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Pequeño" ? "checked" : "" }}>
                    <span class="form-check-label">Pequeño</span>
                </label>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h3>Raza</h3>
                <label for="raza" class="form-check">
                    <select class="form-control" name="raza" id="raza">
                        <option value="">-</option>
                        @foreach(\App\Models\Mascota::getRazas() as $raza)
                            @if($raza)
                                <option value="{{ $raza }}"{{ isset($_GET["raza"]) && $_GET["raza"] == $raza ? "selected" : "" }}>{{ $raza }}</option>
                            @endif
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h3>Otros datos</h3>
                <label for="urgente" class="form-check">
                    <input class="form-check-input" type="checkbox" name="urgente" id="urgente"
                           value="1" {{ isset($_GET["urgente"]) && $_GET["urgente"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">Urgente</span>
                </label>
                <label for="esterilizado" class="form-check">
                    <input class="form-check-input" type="checkbox" name="esterilizado" id="esterilizado"
                           value="1" {{ isset($_GET["esterilizado"]) && $_GET["esterilizado"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">Esterilizado</span>
                </label>
                <label for="sociable" class="form-check">
                    <input class="form-check-input" type="checkbox" name="sociable" id="sociable"
                           value="1" {{ isset($_GET["sociable"]) && $_GET["sociable"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">Sociable</span>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col12 col-lg-6">
                <button onclick="limpiarFiltro()" style="width: 100%" class="btn btn-petfy">Limpiar</button>
            </div>
            <div class="col-12 col-lg-6">
                <button type="submit" style="width: 100%" class="btn btn-petfy">Filtrar</button>
            </div>
        </div>
    </form>
    </div>
</div>
<script>
    function limpiarFiltro() {
        $("#filtro :input").each(function () {
            $(this).prop("checked", false);
            $(this).prop("selected", false);
        })
        $("#raza").val("-");
    }
    function toggleFiltro() {
        $("#filtro-container").slideToggle(500);
        @php
        session("filtro") === 0 ? session(["filtro" => 1]) : session(["filtro" => 0]);
        @endphp
    }
    $(document).ready(function () {
        $("#busqueda").autocomplete({
            source: function (request, response) {
                let especie = $("#especie").id;
                $.ajax({
                    type: "POST",
                    url: "{{url("mascotas/busqueda")}}",
                    dataType: "json",
                    data: {
                        "_token": "{{csrf_token()}}",
                        "busqueda": request.term,
                        "especie": especie
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            position: {
                my: "left+0 top+8"
            },
            select: function (event, ui) {
                window.location = window.location.origin + "/mascota/" + convertToSlug(ui.item.value);
            }
        });

        function convertToSlug(text) {
            text = text.normalize("NFD") // Normalizamos para obtener los códigos
                .replace(/[\u0300-\u036f|.,\/#!$%\^&\*;:{}=\-_`~()]/g, "") // Quitamos los acentos y símbolos de puntuación
                .replace(/ +/g, '-') // Reemplazamos los espacios por guiones
                .toLowerCase(); // Todo minúscula
            return text;
        }
    })

</script>
