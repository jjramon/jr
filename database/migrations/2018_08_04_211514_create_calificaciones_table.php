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
            $table->integer('idAlumno');
            $table->integer('idCatedra');
            $table->integer('idBimestre');
            $table->integer('calificacion');
            $table->timestamps();
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade');
            $table->foreign('idCatedra')->references('id')->on('catedras')->onUpdate('cascade');
            $table->foreign('idBimestre')->references('id')->on('bimestres')->onUpdate('cascade');
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
