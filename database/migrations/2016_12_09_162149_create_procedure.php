<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::unprepared('
            CREATE PROCEDURE proc_qtd_favorito(produto_id INT(11))
            BEGIN
                UPDATE produtos SET qtd_favorito = (qtd_favorito + 1) WHERE id = produto_id;
            END
         ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
