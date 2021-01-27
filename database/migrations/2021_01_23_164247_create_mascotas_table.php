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
            $table->string("imagen");
            $table->date("fechaNacimiento");
            $table->integer("peso")->unsigned();
            $table->string("sexo", 5);
            $table->foreignId("users_id");
            $table->foreignId("especies_id");
            $table->timestamps();
            $table->foreign("users_id")->references("id")->on("users");
            $table->foreign("especies_id")->references("id")->on("especies");
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
