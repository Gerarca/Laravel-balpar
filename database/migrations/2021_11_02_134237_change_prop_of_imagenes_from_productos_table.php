<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePropOfImagenesFromProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
            $table->string('imagen2')->nullable()->change();
            $table->string('imagen3')->nullable()->change();
            $table->string('imagen4')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('imagen');
            $table->string('imagen2');
            $table->string('imagen3');
            $table->string('imagen4');
        });
    }
}
