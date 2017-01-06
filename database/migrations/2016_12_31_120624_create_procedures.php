<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(
            'CREATE PROCEDURE procQtdFavorito (produto_id INT(11))
            BEGIN
                UPDATE produtos SET qtd_favorito = (qtd_favorito + 1) WHERE id = produto_id;
            END'
        );        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procQtdFavorito');
    }
}
