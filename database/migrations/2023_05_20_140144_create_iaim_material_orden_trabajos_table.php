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
        Schema::create('iaim_material_orden_trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_ot');
            $table->string('codigo_producto');
            $table->string('descripcion');
            $table->string('categoria');
            $table->integer('cantidad');
            $table->string('existencia_total');
            $table->string('usuario_responsable');
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
        Schema::dropIfExists('iaim_material_orden_trabajos');
    }
};
