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
            $table->foreignId("especie_id");
            $table->date("fechaNacimiento");
            $table->string("sexo", 6);
            $table->string("tamano")->nullable();
            $table->string("raza")->nullable();
            $table->string("color")->nullable();
            $table->string("pelaje")->nullable();
            $table->boolean("urgente")->default(false);
            $table->boolean("sociable")->nullable();
            $table->boolean("esterilizado")->nullable();
            $table->text("descripcion")->nullable();
            $table->string("imagen");
            $table->foreignId("refugio_id");
            $table->boolean("adoptado")->default(false);

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
