<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsignarHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignar_horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria')->unsigned();
            $table->integer('idHorario')->unsigned();
            $table->integer('idCiclo')->unsigned();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idMateria')->references('id')->on('materias')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idHorario')->references('id')->on('horarios')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('asignar_horarios');
    }
}
