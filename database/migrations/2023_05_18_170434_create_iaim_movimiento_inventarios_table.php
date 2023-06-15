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
        Schema::create('iaim__movimiento__inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('articulo_id');
            $table->string('codigo');
            $table->string('descripcion');
            $table->string('categoria');
            $table->integer('entrada')->default(0);
            $table->string('fecha_entrada');
            $table->integer('salida')->default(0);
            $table->string('fecha_salida');
            $table->string('codigo_ot')->nullable();
            $table->string('tipo_mov')->nullable(); // 1-> entrada 2-> salida
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
        Schema::dropIfExists('iaim__movimiento__inventarios');
    }
};
