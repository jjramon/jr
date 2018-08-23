<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_alumnos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria');
            $table->integer('idAlumno');
            $table->timestamps();
            $table->foreign('idAlumno')->references('id')->on('personas')->onUpdate('cascade');
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_alumnos');
    }
}
