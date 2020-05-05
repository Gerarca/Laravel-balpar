<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('marca_id');
            $table->unsignedBigInteger('uso_id')->nullable();
            $table->unsignedBigInteger('rubro_id')->nullable();
            $table->string('nombre');
            $table->text('subtitulo');
            $table->string('cod_articulo')->unique();
            $table->text('descripcion');
            $table->text('informacion');
            $table->string('imagen');
            $table->string('imagen2');
            $table->string('imagen3');
            $table->string('imagen4');
            $table->integer('visible')->default(0);
            $table->integer('destacado_comercial')->default(0);
            $table->integer('destacado_industrial')->default(0);
            $table->integer('stock')->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('marca_id')->references('id')->on('marcas')->onDelete('cascade');
            $table->foreign('uso_id')->references('id')->on('usos');
            $table->foreign('rubro_id')->references('id')->on('rubros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
