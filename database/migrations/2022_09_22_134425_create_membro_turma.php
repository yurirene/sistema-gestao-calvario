<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembroTurma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membro_turma', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('membro_id')->unsigned();
            $table->bigInteger('turma_id')->unsigned();
            $table->timestamps();

            $table->foreign('membro_id')->references('id')->on('membros')->onDelete('cascade');
            $table->foreign('turma_id')->references('id')->on('turmas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membro_turma');
    }
}
