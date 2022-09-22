<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membros', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->date('nascimento')->nullable();
            $table->char('sexo', 1);
            $table->string('telefone')->nullable();
            $table->year('ano_membresia')->nullable();
            $table->bigInteger('cargo_id')->unsigned()->nullable();
            $table->boolean('ativo')->default(true);
            $table->date('inativado_em')->nullable();
            $table->timestamps();

            $table->foreign('cargo_id')->references('id')->on('cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membros');
    }
}
