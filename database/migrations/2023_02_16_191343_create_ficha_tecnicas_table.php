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
        Schema::create('ficha_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable();
            $table->string('qrConden');
            $table->string('tipoConden')->nullable();
            $table->string('voltaje');
            $table->string('phases');
            $table->string('tipoRefri');
            $table->string('btu');
            $table->decimal('costo', 18, 2)->nullable()->default(0.00);
            $table->string('tipoCompresor');
            $table->string('marcaCompresor');
            $table->string('ampCompresor');
            $table->string('imgPlacaCompresor');
            $table->string('tipoVentilador');
            $table->string('imgEtiqVentilador');
            $table->string('qrEvaporador')->nullable();
            $table->string('imgEvaporador')->nullable();
            $table->string('oficina');
            $table->string('piso');
            $table->string('agencia');
            $table->string('estado');
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
        Schema::dropIfExists('ficha_tecnicas');
    }
};
