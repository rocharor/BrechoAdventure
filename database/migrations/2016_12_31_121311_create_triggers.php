<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tgr_insert_qtd_favorito AFTER INSERT ON `favoritos` FOR EACH ROW
            BEGIN
                CALL proc_qtd_favorito(NEW.produto_id);
            END
        ');

        DB::unprepared('
            CREATE TRIGGER tgr_update_qtd_favorito AFTER UPDATE ON `favoritos` FOR EACH ROW
            BEGIN
                IF(NEW.status = 1)
                THEN
                    CALL proc_qtd_favorito(NEW.produto_id);
                END IF;
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
        Schema::dropIfExists('tgr_insert_qtd_favorito');
        Schema::dropIfExists('tgr_update_qtd_favorito');
    }
}
