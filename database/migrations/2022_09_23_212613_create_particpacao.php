<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticpacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participacoes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('membro_id')->unsigned();
            $table->bigInteger('programacao_id')->unsigned();
            $table->timestamps();

            $table->foreign('membro_id')->references('id')->on('membros')->onDelete('cascade');
            $table->foreign('programacao_id')->references('id')->on('programacoes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participacoes');
    }
}
