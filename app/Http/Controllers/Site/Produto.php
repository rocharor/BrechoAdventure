<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto as ProdutoModel;

class Produto extends Controller
{
    public $model;

    public function __construct(ProdutoModel $produto)
    {
        $this->model = $produto;
    }

    public function indexAction()
    {
        $produtos = $this->model->getProdutos(9);

        return view('site/produto',['logado'=>0,'produtos'=>$produtos,'logado'=>0]);
    }


    public function getDescricaoProdutoAction()
    {
        $produto_id = $_GET['produto_id'];

        $produtos = $this->model->getDescricaoProduto($produto_id);

        //echo json_encode($arrProduto[0]);
        //echo response($produtos)->content();
        echo response()->json($produtos)->content();
        die();
    }
}
