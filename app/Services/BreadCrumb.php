<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait BreadCrumb
{
    private $listBreadCrumb = [
        'home'=>[],
        'produtos'=>['Produtos'],
        'visualizar-produto'=>['Visualizar Produto'],
        'contato'=>['Contato'],
        'minha-conta.profile'=>['profile'],
        'minha-conta.meus-favorito'=>['Meus Favoritos'],
        'minha-conta.mensagem'=>['Minhas Mensagens'],
        'minha-conta.meus-produto'=>['Meus Produtos'],
        'minha-conta.create-produto'=>['Cadastrar Produto'],
        'minha-conta.editar-produto'=>['Meus Produtos', 'Editar Produto'],
    ];

    public function getBreadCrumb()
    {
        $routeName = Route::getCurrentRoute()->getName();
        return $breadCrumb = isset($this->listBreadCrumb[$routeName]) ? json_encode($this->listBreadCrumb[$routeName]) : '';
    }
}
