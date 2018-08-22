<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;

class HomeController extends Controller
{
    private $model;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index(Favorito $favorito)
    {
        $this->model->paginacao = true;
        $produtos = $this->model->getProdutos();

        $favoritos = $favorito->getFavoritos();
        foreach($produtos['itens'] as $produto){
            $produto->imgPrincipal = $this->imagemPrincipal($produto->nm_imagem);

            $produto->favorito = false;
            foreach($favoritos['itens'] as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        $produtos['user'] = json_encode([
            'logged' => Auth::check(),
            'id' => Auth::check() ? Auth::user()->id : 0,
        ]);

        return view('site/home',[
            'produtos'=>$produtos,
            'breadCrumb' => $this->getBreadCrumb()
        ]);

    }
}
