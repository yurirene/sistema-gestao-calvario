<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencias', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('aula_id')->unsigned();
            $table->bigInteger('aluno_id')->unsigned();
            $table->timestamps();

            $table->foreign('aula_id')->references('id')->on('aulas')->onDelete('cascade');
            $table->foreign('aluno_id')->references('id')->on('membros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frequencias');
    }
}
