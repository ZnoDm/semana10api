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
        Schema::create('carrito_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cantidad');
            $table->decimal('precio', 10, 2);
            $table->unsignedBigInteger('carrito_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('carrito_id')->references('carrito_id')->on('carrito');
            $table->foreign('producto_id')->references('producto_id')->on('producto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_producto');
    }
};
