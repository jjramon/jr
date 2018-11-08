<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria')->unsigned();
            $table->integer('idBimestre')->unsigned();
            $table->integer('idDocente')->unsigned();
            $table->integer('idAlumno')->unsigned();
            $table->integer('calificacion');
            $table->integer('idCiclo')->unsigned();
            $table->integer('promedio');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idBimestre')->references('id')->on('bimestres')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idDocente')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('calificaciones');
    }
}
