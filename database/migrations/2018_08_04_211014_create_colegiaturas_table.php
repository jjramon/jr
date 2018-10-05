<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColegiaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colegiaturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAlumno')->unsigned();
            $table->date('fecha');
            $table->integer('idMes')->unsigned();
            $table->integer('idCiclo')->unsigned();
            $table->boolean('condicion')->default(1);
            $table->decimal('pago');
            $table->timestamps();
            $table->foreign('idAlumno')->references('id')->on('alumnos')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idMes')->references('id')->on('meses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('idCiclo')->references('id')->on('ciclos')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('colegiaturas');
    }
}
