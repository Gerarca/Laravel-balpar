<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cod_ciudad')->nullable();
            $table->string('nombre')->nullable();
            $table->string('documento')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('empresa')->nullable();
            $table->text('mensaje')->nullable();
            $table->string('direccion')->nullable();
            $table->string('referencias')->nullable();
            $table->string('metodo')->nullable();
            $table->string('observaciones')->nullable();
            $table->bigInteger('total')->nullable()->default('0');
            $table->bigInteger('monto_envio')->nullable()->default('0');
            $table->bigInteger('monto_total')->nullable()->default('0');
            $table->integer('estado')->default('0');

            $table->timestamps();



            $table->foreign('cod_ciudad')->references('id')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
