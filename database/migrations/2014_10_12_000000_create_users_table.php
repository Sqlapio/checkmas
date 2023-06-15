<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('ci_rif')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('direccion')->nullable();
            $table->string('cargo')->nullable();
            $table->string('division')->nullable();
            $table->string('coordinacion')->nullable();
            $table->string('firma_digital')->nullable();
            $table->string('rol');
            $table->string('agencia')->nullable();
            $table->string('estado')->nullable();
            $table->string('status_registro')->default(0);
            $table->string('empresa')->nullable();
            $table->string('activo')->default(0);
            $table->integer('contador')->default(0);
            $table->foreignId('empresa_id')->constrained();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
