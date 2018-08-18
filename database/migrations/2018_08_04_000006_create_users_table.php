<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('idTipoPersona');
            $table->integer('idGenero');
            $table->string('identificacion',15);
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('tel',15);
            $table->string('direccion', 80);
            $table->string('email', 80);
            $table->date('fechaNacimiento');
            $table->boolean('estado',1);
            $table->string('usuario',25)->nullable();
            $table->string('password',25)->nullable();
            $table->foreign('idGenero')->references('id')->on('generos')->onUpdate('cascade');
            $table->foreign('idTipoPersona')->references('id')->on('tipoPersona')->onUpdate('cascade');
            $table->rememberToken();
            $table->timestamps();
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
