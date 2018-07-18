<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->string('titulo', 100);
            $table->text('descricao');
            $table->string('valor');
            $table->string('estado', 100);
            $table->string('nm_imagem');
            $table->string('slug')->unique()->nullable();
            $table->integer('qtd_favorito')->default(0);
            $table->integer('status')->default(2);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['slug']);

            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('categoria_id')->references('id')->on('categorias')
            ->onUpdate('cascade')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
