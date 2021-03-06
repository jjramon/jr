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
            $table->integer('idGrado')->unsigned();
            $table->integer('idAlumno')->unsigned();
            $table->integer('idCiclo')->unsigned();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idGrado')->references('id')->on('grados')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('asignar_alumnos');
    }
}
