<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTesourariaMovimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tesouraria_movimentos', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->decimal('valor', 10, 2);
            $table->string('descricao');
            $table->tinyInteger('tipo')->comment('0: Saida | 1: Entrada');
            $table->string('path_comprovante')->nullable();
            $table->bigInteger('categoria_id')->unsigned();
            $table->bigInteger('membro_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('membro_id')->references('id')->on('membros');
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
        Schema::dropIfExists('tesouraria_movimentos');
    }
}
