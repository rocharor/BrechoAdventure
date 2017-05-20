<?php

namespace App\Services;

use Illuminate\Http\Request;
use Route;

trait BreadCrumb
{
    public $breadCrumb = [
        'home'=>'',
        'produtos'=>'Produtos',
        'visualizarProduto'=>'Visualizar Produto',
        'contato'=>'Contato',
        'minha-conta.perfil'=>'Perfil',
        'minha-conta.meusFavorito'=>'Meus Favoritos',
        'minha-conta.mensagem'=>'Minhas Mensagens',
        'minha-conta.meusProduto'=>'Meus Produtos',
        'minha-conta.createProduto'=>'Cadastrar Produto',
        'minha-conta.editar-produto'=>['Meus Produtos', 'Editar Produto'],


    ];

    public function getBreadCrumb()
    {

        // dd( Route::getCurrentRoute()->getName() );
    }
}
