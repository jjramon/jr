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
            $table->decimal('conducta');
            $table->decimal('colaboracion');
            $table->decimal('asistencia');
            $table->decimal('uniforme');
            $table->decimal('actividades');
            $table->decimal('examen');
            $table->string('observaciones', 150)->nullable();
            $table->timestamps();
            $table->foreign('idCalificacion')->references('id')->on('calificaciones')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_calificaciones');
    }
}
