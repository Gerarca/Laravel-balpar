<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposToTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trabajos', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
            $table->string('video')->nullable()->after('imagen');
            $table->integer('tipo')->default(1)->comment('1 imagen, 2 video')->after('descripcion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trabajos', function (Blueprint $table) {
            $table->string('imagen')->change();
            $table->dropColumn('video');
            $table->dropColumn('tipo');
        });
    }
}
