<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_calificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCalificacion')->unsigned();
            $table->integer('conducta');
            $table->integer('zona');
            $table->integer('asistencia');
            $table->integer('examen');
            $table->string('Observaciones', 150)->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->foreign('idCalificacion')->references('id')->on('calificaciones')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_calificaciones');
    }
}
