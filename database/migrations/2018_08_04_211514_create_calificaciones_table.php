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
            $table->integer('calificacion');
            $table->integer('idciclo')->unsigned();
            $table->integer('promedio');
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade');
            $table->foreign('idBimestre')->references('id')->on('bimestres')->onUpdate('cascade');
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade');
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
