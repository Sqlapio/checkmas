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
        Schema::create('iaim__orden_compras', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 45);
            $table->string('fecha_orden_compra', 45);
            $table->string('fecha_entrega_orden_compra', 45);
            $table->string('fecha_limite_orden_compra', 45);
            $table->string('estado_orden_compra', 45);
            $table->string('id_proveedor', 45);
            $table->string('id_usuario', 45);
            $table->string('id_sucursal', 45);
            $table->string('id_almacen', 45);
            $table->string('id_tipo_orden_compra', 45);
            $table->string('id_tipo_pago', 45);
            $table->string('id_tipo_documento', 45);
            $table->string('id_tipo_documento_detalle', 45);
            $table->string('id_tipo_documento_detalle_2', 45);
            $table->string('id_tipo_documento_detalle_3', 45);
            $table->string('id_tipo_documento_detalle_4', 45);
            $table->string('id_tipo_documento_detalle_5', 45);
            $table->string('id_tipo_documento_detalle_6', 45);
            $table->string('id_tipo_documento_detalle_7', 45);
            $table->string('id_tipo_documento_detalle_8', 45);
            $table->string('id_tipo_documento_detalle_9', 45);
            $table->string('id_tipo_documento_detalle_10', 45);
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
        Schema::dropIfExists('iaim__orden_compras');
    }
};
