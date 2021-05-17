@extends("layouts.master.master")

@section("title")
    Sobre Nosotros
@endsection

@section("main")
    {{ \DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs::render("about-us") }}
@endsection
