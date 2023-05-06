<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroVisitante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('programacoes', function($table) {
            $table->integer('visitantes_criancas')->default(0);
            $table->text('nome_visitantes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('programacoes', function($table) {
            $table->dropColumn('visitantes_criancas');
            $table->dropColumn('nome_visitantes');
        });
    }
}
