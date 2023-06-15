<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iaim_certificacion_orden_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('ot_id')->nullable();
            $table->string('codigo_ot')->nullable();
            $table->string('fecha_inicio_ot')->nullable();
            $table->string('fecha_fin_ot')->nullable();
            $table->string('fecha_cer_ot')->nullable();
            $table->string('usr_cer_nombre')->nullable();
            $table->string('usr_cer_cedula')->nullable();
            $table->string('usr_cer_cargo')->nullable();
            $table->string('usr_cer_firma')->nullable();
            $table->string('usr_cer_correo')->nullable();
            $table->string('usr_cer_division')->nullable();
            $table->string('usr_cer_coordinacion')->nullable();
            $table->string('can_dias')->nullable();
            $table->string('can_trabajadores')->nullable();
            $table->string('foto_antes_1')->nullable();
            $table->string('foto_antes_2')->nullable();
            $table->string('foto_antes_3')->nullable();
            $table->string('foto_durante_1')->nullable();
            $table->string('foto_durante_2')->nullable();
            $table->string('foto_durante_3')->nullable();
            $table->string('foto_des_1')->nullable();
            $table->string('foto_des_2')->nullable();
            $table->string('foto_des_3')->nullable();
            $table->string('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('iaim_certificacion_orden_trabajos');
    }
};
