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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->string('nro_ot');
            $table->string('agencia');
            $table->string('estado');
            $table->string('tipo_fotos');
            $table->string('foto1_antes')->nullable();
            $table->string('foto2_antes')->nullable();
            $table->string('observaciones_antes')->nullable();
            $table->string('foto1_despues')->nullable();
            $table->string('foto2_despues')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('tecnico');
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
        Schema::dropIfExists('bitacoras');
    }
};
