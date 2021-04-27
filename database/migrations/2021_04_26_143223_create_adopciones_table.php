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
            $table->timestamps();

            $table->primary(["mascota_id", "familia_id"]);
            $table->foreign("mascota_id")->references("id")->on("mascotas");
            $table->foreign("familia_id")->references("id")->on("users");
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
