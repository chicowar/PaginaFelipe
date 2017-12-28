<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empresaubicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('empresaubicacions', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('id_empresas');
            $table->string('id_compania');
            $table->string('direccion');
            $table->string('detalle');
            $table->float('lat');
            $table->float('lng');
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
        Schema::dropIfExists('empresaubicacions');
    }
}
