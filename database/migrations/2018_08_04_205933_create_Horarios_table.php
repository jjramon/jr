<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMateria');
            $table->time('horario');
            $table->time('horario_salida');
            $table->integer('idDia');
            $table->timestamps();
            $table->boolean('estado')->default(1);
            $table->foreign('idDia')->references('id')->on('dias')->onUpdate('cascade');
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
        Schema::dropIfExists('horarios');
    }
}
