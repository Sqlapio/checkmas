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
        Schema::create('iaim_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->string('codigo');
            $table->string('categoria');
            $table->string('proveedor');
            $table->decimal('precio_unitario', 18, 2)->nullable()->default(0.00);
            $table->integer('cantidad_minima');
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
        Schema::dropIfExists('iaim_articulos');
    }
};
