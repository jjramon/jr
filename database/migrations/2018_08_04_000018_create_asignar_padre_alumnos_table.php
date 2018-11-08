<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarPadreAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_padre_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAlumno')->unsigned();
            $table->integer('idPersona')->unsigned();
            $table->integer('idCiclo')->unsigned();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idPersona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade')->onDelete('cascade');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_padre_alumnos');
    }
}
