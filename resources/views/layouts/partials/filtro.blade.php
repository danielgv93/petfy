<div class="col-12 mb-5">
    <h2>Filtro</h2>
    <div>
        <form class="row" id="filtro" action="{{route("mascotas", \Illuminate\Support\Facades\Request::segment(2))}}">
            <div class="col-6">
                <h3>Sexo</h3>
                <label for="macho" class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="macho"
                           value="Macho" {{ isset($_GET["sexo"]) && $_GET["sexo"] == "Macho" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Macho
				  </span>
                </label>
                <label for="hembra" class="form-check">
                    <input class="form-check-input" type="radio" name="sexo" id="hembra"
                           value="Hembra" {{ isset($_GET["sexo"]) && $_GET["sexo"] == "Hembra" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Hembra
				  </span>
                </label>
                <h3>Tamaño</h3>
                <label for="grande" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="grande"
                           value="Grande" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Grande" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Grande
				  </span>
                </label>
                <label for="mediano" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="mediano"
                           value="Mediano" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Mediano" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Mediano
				  </span>
                </label>
                <label for="pequeno" class="form-check">
                    <input class="form-check-input" type="radio" name="tamano" id="pequeno"
                           value="Pequeño" {{ isset($_GET["tamano"]) && $_GET["tamano"] == "Pequeño" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Pequeño
				  </span>
                </label>
            </div>
            <div class="col-6">
                <h3>Raza</h3>
                <label for="pequeno" class="form-check">
                    <select name="raza" id="raza">
                        <option value="">-</option>
                        @foreach(\App\Models\Mascota::getRazas() as $raza)
                            @if($raza)
                                <option
                                    value="{{ $raza }}" {{ isset($_GET["raza"]) && $_GET["raza"] == $raza ? "selected" : "" }}>{{ $raza }}</option>
                            @endif
                        @endforeach
                    </select>
                </label>
                <h3>Otros datos</h3>
                <label for="urgente" class="form-check">
                    <input class="form-check-input" type="checkbox" name="urgente" id="urgente"
                           value="1" {{ isset($_GET["urgente"]) && $_GET["urgente"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Urgente
				  </span>
                </label>
                <label for="esterilizado" class="form-check">
                    <input class="form-check-input" type="checkbox" name="esterilizado" id="esterilizado"
                           value="1" {{ isset($_GET["esterilizado"]) && $_GET["esterilizado"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Esterilizado
				  </span>
                </label>
                <label for="sociable" class="form-check">
                    <input class="form-check-input" type="checkbox" name="sociable" id="sociable"
                           value="1" {{ isset($_GET["sociable"]) && $_GET["sociable"] == "1" ? "checked" : "" }}>
                    <span class="form-check-label">
				    Sociable
				  </span>
                </label>
            </div>
            <button onclick="limpiarFiltro()" style="width: 50%" class="btn btn-petfy">Limpiar Filtro</button>
            <input type="submit" style="width: 50%" class="btn btn-petfy" value="Aplicar filtro">
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
</script>
