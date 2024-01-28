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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('cliente_id');
            $table->string('ruc_dni', 11)->nullable();
            $table->string('nombres', 80)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('direccion', 100)->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->string('apellidos', 80)->nullable();
            $table->string('url', 1000)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
};
