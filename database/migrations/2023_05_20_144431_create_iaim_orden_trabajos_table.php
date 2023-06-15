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
        Schema::create('iaim_orden_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_ot');
            $table->string('aeropuerto')->nullable();
            $table->string('area')->nullable();
            $table->string('fecha_ot')->nullable();
            $table->string('reportado_por')->nullable();
            $table->string('divicion')->nullable();
            $table->string('coordinacion')->nullable();
            $table->string('descripcion_general')->nullable();
            /**
             * Datos de la persona que realiza la inspeccion
             */
            $table->string('usr_res_nombre')->nullable();
            $table->string('usr_res_cedula')->nullable();
            $table->string('usr_res_cargo')->nullable();
            $table->string('usr_res_firma')->nullable();
            $table->string('usr_res_correo')->nullable();
            $table->string('valor_urgencia')->default('0');
            $table->string('valor_obra')->default('0');
            $table->string('otras_diviciones')->default('0');
            $table->string('otra_divicion')->default('0');
            $table->string('recomendaciones')->default('0');
            $table->string('status')->default('1');
            $table->string('aprobada_por')->nullable();
            $table->string('fecha_aprobacion')->nullable();
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
        Schema::dropIfExists('iaim_orden_trabajos');
    }
};
