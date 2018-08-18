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
        Schema::create('detalleCalificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCalificacion');
            $table->integer('conducta');
            $table->integer('zona');
            $table->integer('asistencia');
            $table->integer('examen');
            $table->string('Observaciones', 80);
            $table->timestamps();
            $table->foreign('idCalificacion')->references('id')->on('calificaciones')->onUpdate('cascade');
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
