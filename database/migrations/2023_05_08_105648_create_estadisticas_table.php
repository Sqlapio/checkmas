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
        Schema::create('estadisticas', function (Blueprint $table) {
            $table->id();
            $table->string('total_ticket_abiertos')->default(0);
            $table->string('total_ticket_cerrados')->default(0);
            $table->string('total_ot_mc_creada')->default(0);
            $table->string('total_ot_mc_aprobada')->default(0);
            $table->string('total_ot_mc_ejecucion')->default(0);
            $table->string('total_ot_mc_supervicion')->default(0);
            $table->string('total_ot_mc_finalizada')->default(0);
            $table->decimal('total_inversion_mc', 18, 2)->nullable()->default(0.00);
            $table->string('total_ot_mp_creada')->default(0);
            $table->string('total_ot_mp_aprobada')->default(0);
            $table->string('total_ot_mp_ejecucion')->default(0);
            $table->string('total_ot_mp_supervicion')->default(0);
            $table->string('total_ot_mp_finalizada')->default(0);
            $table->decimal('total_inversion_mp', 18, 2)->nullable()->default(0.00);
            $table->string('estado')->nullable();
            $table->string('color')->nullable();
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
        Schema::dropIfExists('estadisticas');
    }
};
