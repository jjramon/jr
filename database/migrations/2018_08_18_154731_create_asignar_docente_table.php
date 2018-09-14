<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarDocenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_docente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria')->unsigned();
            $table->integer('idMaestro')->unsigned();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idMaestro')->references('id')->on('personas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignar_docente');
    }
}
