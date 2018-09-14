<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_materia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idGrado')->unsigned();
            $table->integer('idMateria')->unsigned();
            $table->timestamps();
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idGrado')->references('id')->on('grados')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_materia');
    }
}
