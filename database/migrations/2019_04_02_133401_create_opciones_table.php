<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('opciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('type');
            $table->text('name');
            $table->text('value')->nullable();
            $table->integer('group')->nullable();
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
      Schema::dropIfExists('opciones');
    }
}
