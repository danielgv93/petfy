<style>
    * {
        box-sizing: border-box;
    }

    h1, h2 {
        text-align: center;
    }

    h1 {
        text-decoration: underline;
    }
    li {
        line-height: 150%;
    }

    .preFirma {
        text-align: center;
        font-style: italic;
        text-transform: uppercase;
    }

    .column {
        float: left;
        width: 50%;
        padding: 10px;
        height: 300px;
    }

    .row:after {
        content: "";
        display: table;
        clear: both;
    }
</style>
<h1>CONTRATO DE ADOPCION</h1>
<h2>COMPARECIENDO</h2>
<p>De una parte, D./Dña. {{ $familia->name }}, en su propio nombre y Derecho, con DNI {{ $familia->nif }}, con domicilio
    en
    {{ $familia->direccion }}, y e-mail {{ $familia->email }} , en adelante el <strong>Adoptante</strong>.</p>
<p>Y, de otra parte, el refugio {{ $refugio->name }}, con CIF {{ $refugio->nif }}, con
    domicilio {{ $refugio->direccion }} y con e-mail
    {{ $refugio->email }}, en adelante el <strong>Refugio</strong>. </p>
<p>Ambas partes acuerdan celebrar el presente <strong>CONTRATO</strong>, de acuerdo con las siguientes estipulaciones:
</p>
<h2>ESTIPULACIONES</h2>
<ol>
    <li>El Adoptante se compromete a adoptar al animal de el Refugio con los datos que se reseñan a continuación:
        <ul>
            <li>Especie: {{ $mascota->especie->especie }}</li>
            <li>Raza: {{ $mascota->raza }}</li>
            <li>Sexo: {{ $mascota->sexo }}</li>
            <li>Fecha nacimiento: {{ $mascota->fechaNacimiento }}</li>
        </ul>
        <p>En adelante la <strong>Mascota</strong>.</p>
    </li>
    <li>El adoptante declara adoptar al animal única y exclusivamente como animal de compañía.</li>
    <li>El animal entregado en adopción no podrá ser utilizado para:
        <ul>
            <li>Experimentación de cualquier tipo.</li>
            <li>La participación en peleas o enfrentamientos con otros animales.</li>
            <li>La cría.</li>
            <li>Caza.</li>
            <li>Participación en cualquier tipo de espectáculo.</li>
        </ul>
    </li>
    <li>En ningún caso se podrá someter al animal a cualquier forma de maltrato, tratamiento indebido o contrario a las
        disposiciones de la Ley de Protección Animal vigente, normativa que la desarrolle, y Código Penal. Esto incluye
        la prohibición de realizar la desungulación al animal adoptado o el corte de rabo.
    </li>
    <li> El adoptante se compromete a proporcionar al animal alimentación y bebida suficiente y adecuada, prestarle los
        cuidados de higiene necesarios, la debida asistencia veterinaria, cuidarlo y respetarlo.
    </li>
    <li>Asimismo se compromete a no regalar, vender o ceder por cualquier título al animal; en caso de no poder hacerse
        cargo de este por cualquier causa, se pondrá en contacto con el Refugio que recuperará la custodia y
        propiedad del mismo.
    </li>
    <li>Para proceder a la eutanasia del animal (por motivos diferentes a enfermedad terminal), se requerirá el
        consentimiento previo de el Refugio. En caso de discrepancia, esta última se hará cargo de aquél.
    </li>
    <li>La desaparición del animal, por robo, perdida, extravío o por cualquier otra causa, debe ser notificada a la
        Asociación, a fin de que colabore en su búsqueda. El Adoptante debe interponer la correspondiente denuncia en la
        Comisaría de la Policía Local.
    </li>
    <li>El adoptante se compromete a esterilizar al animal en caso de no estar esterilizado por motivos de salud o por
        no alcanzar la edad adecuada (cachorros) en el plazo máximo de un año. En caso de ignorar la norma y preñar el
        animal o usarlo para cría, la asociación podría reclamar la devolución del mismo para pasar a ser custodiado por
        la asociación. PROHIBICIÓN ABSOLUTA DE CRÍAR CON EL ANIMAL ADOPTADO.
    </li>
    <li>Las obligaciones anteriormente descritas, tendrán el carácter de condición resolutoria; es decir, el
        incumplimiento de cualquiera de ellas, producirá de pleno de derecho la resolución del contrato, recuperando la
        Asociación de forma inmediata la propiedad y posesión del animal.
    </li>
    <li>Las partes declaran comprender las estipulaciones del presente contrato compuesto por dos folios a una cara, y
        en prueba de conformidad lo firman en el lugar y fecha abajo indicados.
    </li>
</ol>
<p class="preFirma">EN {{ $refugio->ciudad }} A {{ \Carbon\Carbon::now()->isoFormat("D") }}
    DE {{ \Carbon\Carbon::now()->isoFormat("MMMM") }} DE {{ \Carbon\Carbon::now()->isoFormat("YYYY") }}</p>

<div class="row">
    <div class="column">
        <p>Firma adoptante:</p>
    </div>
    <div class="column">
        <p>Firma refugio:</p>
    </div>
</div>
