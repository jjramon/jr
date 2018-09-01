<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idNivel')->unsigned();
            $table->integer('idSeccion')->unsigned();
            $table->integer('idMateria')->unsigned();
            $table->integer('idAlumno')->unsigned();
            $table->string('nombre',20);
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idNivel')->references('id')->on('niveles')->onUpdate('cascade');
            $table->foreign('idSeccion')->references('id')->on('secciones')->onUpdate('cascade');
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade');
            $table->foreign('idAlumno')->references('id')->on('persona')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grados');
    }
}
