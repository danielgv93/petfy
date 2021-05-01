<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->string("slug");
            $table->string("imagen");
            $table->date("fechaNacimiento");
            $table->boolean("adoptado")->default(false);
            $table->integer("peso")->unsigned();
            $table->string("sexo", 6);
            $table->string("raza")->nullable();
            $table->string("color")->nullable();
            $table->string("pelaje")->nullable();
            $table->text("descripcion")->nullable();
            $table->date("fecha_adopcion")->nullable();
            //Campos Perro
            $table->string("tamano")->nullable();
            //Campos Gato

            //Foreign Keys
            $table->foreignId("refugio_id");
            $table->foreignId("especie_id");
            $table->timestamps();

            $table->foreign("refugio_id")->references("id")->on("users");
            $table->foreign("especie_id")->references("id")->on("especies");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}
