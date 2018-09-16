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
            $table->timestamps();
            $table->foreign('idPersona')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
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