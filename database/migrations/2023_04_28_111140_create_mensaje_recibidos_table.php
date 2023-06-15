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
        Schema::create('mensaje_recibidos', function (Blueprint $table) {
            $table->id();
            $table->string('receptor')->nullable();
            $table->string('emisor')->nullable();
            $table->string('fecha_recibido')->nullable();
            $table->string('fecha_respuesta')->nullable();
            $table->string('asunto')->nullable();
            $table->string('mensaje')->nullable();
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
        Schema::dropIfExists('mensaje_recibidos');
    }
};
