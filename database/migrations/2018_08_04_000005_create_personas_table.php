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
            $table->integer('idGenero')->unsigned();
            $table->integer('idPadre')->nullable();
            $table->integer('idMadre')->nullable();
            $table->integer('idEncargado')->nullable();
            $table->integer('tipoPersona');
            $table->string('identificacion',15);
            $table->string('nombre', 40);
            $table->string('apellido', 40);
            $table->string('tel',15)->nullable();
            $table->string('direccion', 80)->nullable();
            $table->string('email', 80)->nullable()->unique()->index();
            $table->date('fechaNacimiento')->nullable();
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('personas');
    }
}
