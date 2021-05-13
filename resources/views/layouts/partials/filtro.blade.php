<div class="col-12">
    <h2>Filtro</h2>
    <div>
        <form action="{{route("mascotas", \Illuminate\Support\Facades\Request::segment(2))}}">
            <label class="form-check">
                <input class="form-check-input" type="radio" name="sexo" value="Macho">
                <span class="form-check-label">
				    Macho
				  </span>
            </label>
            <label class="form-check">
                <input class="form-check-input" type="radio" name="sexo" value="Hembra">
                <span class="form-check-label">
				    Hembra
				  </span>
            </label>
            <label class="form-check">
                <input class="form-check-input" type="radio" name="tamano" value="Grande">
                <span class="form-check-label">
				    Grande
				  </span>
            </label>
            <label class="form-check">
                <input class="form-check-input" type="radio" name="tamano" value="Mediano">
                <span class="form-check-label">
				    Mediano
				  </span>
            </label>
            <label class="form-check">
                <input class="form-check-input" type="radio" name="tamano" value="Pequeño">
                <span class="form-check-label">
				    Pequeño
				  </span>
            </label>
            <input type="submit" style="width: 50%" class="btn btn-primary adoptar-btn" value="Filtrar">
        </form>
    </div>
</div>
