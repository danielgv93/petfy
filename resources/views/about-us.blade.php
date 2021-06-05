@extends("layouts.master.master")

@section("title")
    Petfy | Sobre Nosotros
@endsection

@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("about-us") }}
    <div class="mb-5">
        <section>
            <h2>¿Qué es Petfy?</h2>
            <p>Petfy es una plataforma cuyo objetivo consiste en colaborar con refugios cántabros en la adopción de
                mascotas.
                Además tratamos de transmitir nuestro respeto y amor por los animales -nuestros valores en definitiva-
                de
                forma que cale entre la mayor población posible, promoviendo la práctica de la adopción como la mejor
                alternativa para encontrar una mascota para las familias.</p>

            <p></p>
        </section>
        <section>
            <h2>Misión - Visión - Valores</h2>
            <p>La misión será sacar de los refugios al máximo número de mascotas posible y darles una familia que les
                cuiden.</p>
            <p>La visión es conseguir que todos los refugios y familias estén interconectados en Cantabria.</p>
            <p>Los valores que serán punta de lanza de este proyecto son la <strong>solidaridad</strong> -ayuda a quien
                más lo necesite en momentos difíciles-, el <strong>compromiso</strong> -de conseguir mejoras en la vida
                de las mascotas y también en los beneficios que estas aportan en la vida de las personas- y
                <strong>pasión</strong> -por los animales y por nuestro trabajo-.
            </p>
        </section>
    </div>
@endsection
