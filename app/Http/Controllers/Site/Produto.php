<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produtos;

class Produto extends Controller
{
    public $model;

    public function __construct(Produtos $produtos)
    {
        $this->model = $produtos;
    }

    public function indexAction()
    {
        $produtos = $this->model->getProdutos();
        return view('site/produto',['logado'=>0,'produtos'=>$produtos,'logado'=>0]);
    }
}
