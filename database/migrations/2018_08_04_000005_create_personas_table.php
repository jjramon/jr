<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
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
            $table->foreign('idGenero')->references('id')->on('generos')->onUpdate('cascade');
            $table->foreign('idTipoPersona')->references('id')->on('tipoPersona')->onUpdate('cascade');
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
        Schema::dropIfExists('empleados');
    }
}
