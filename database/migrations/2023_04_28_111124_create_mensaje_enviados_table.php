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
        Schema::create('mensaje_enviados', function (Blueprint $table) {
            $table->id();
            $table->string('emisor');
            $table->string('receptor');
            $table->string('asunto');
            $table->string('mensaje');
            $table->string('fecha_envio');
            $table->string('fecha_leido')->nullable();
            $table->string('fecha_respuesta')->nullable();
            $table->string('respuesta')->nullable();
            $table->string('estatus')->default('1');

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
        Schema::dropIfExists('mensaje_enviados');
    }
};
