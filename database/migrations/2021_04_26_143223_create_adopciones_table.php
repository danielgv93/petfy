<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdopcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopciones', function (Blueprint $table) {
            $table->foreignId("mascota_id");
            $table->foreignId("familia_id");
            $table->dateTime("fecha_adopcion")->nullable();

            $table->primary(["mascota_id", "familia_id"]);
            $table->foreign("mascota_id")->references("id")->on("mascotas")->cascadeOnDelete();
            $table->foreign("familia_id")->references("id")->on("users")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopciones');
    }
}
