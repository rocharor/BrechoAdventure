<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait BreadCrumb
{
    private $listBreadCrumb = [
        'home'=>[],
        'product'=>['Produto'],
        'product-view'=>['Visualizar Produto'],
        'contact'=>['Contato'],
        'minha-conta.profile'=>['Perfil'],
        'minha-conta.meus-favorito'=>['Meus Favoritos'],
        'minha-conta.mensagem'=>['Minhas Mensagens'],
        'minha-conta.my-product'=>['Meus Produtos'],
        'minha-conta.product-create'=>['Cadastrar Produto'],
        'minha-conta.product-edit'=>['Meus Produtos', 'Editar Produto'],
    ];

    public function getBreadCrumb()
    {
        $routeName = Route::getCurrentRoute()->getName();
        return $breadCrumb = isset($this->listBreadCrumb[$routeName]) ? json_encode($this->listBreadCrumb[$routeName]) : '';
    }
}
