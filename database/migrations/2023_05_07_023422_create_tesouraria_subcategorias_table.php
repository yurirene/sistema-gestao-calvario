<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesourariaSubcategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesouraria_subcategorias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->bigInteger('categoria_id')->unsigned();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('tesouraria_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tesouraria_subcategorias');
    }
}
