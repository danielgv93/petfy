<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('user_role_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('direccion')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('nif')->nullable();
            $table->float('latitud', 8, 6)->nullable();
            $table->float('longitud', 8, 6)->nullable();
            $table->string('direccion_donacion')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();

            $table->foreign("user_role_id")->references("id")->on("user_roles");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
