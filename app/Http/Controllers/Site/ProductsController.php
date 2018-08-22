<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Categoria;



class ProductsController extends Controller
{
    private $model;

    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function index(Favorito $favorito, Request $request, $pagina=1)
    {
        if (count($request->all()) > 0) {
            foreach ($request->all() as $key => $value) {
                $parametros[$key] = explode(',',$value);
            }
            $this->model->parametros = $parametros;
        }

        $this->model->paginacao = true;
        $this->model->pagina = $pagina;
        $produtos = $this->model->getProdutos();
        $numberPages = (int)ceil($produtos['total'] / $this->model->totalPagina);

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

        return view('site/produtos',[
            // 'produtos' => $produtos['itens'],
            'produtos' => $produtos,
            'pg' => $pagina,
            'numberPages' => $numberPages,
            'link' => '/produtos/',
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function show($param)
    {
        $this->getBreadCrumb();
        $produto = $this->model->getProduto($param);

        $imagens = [];
        if ($produto->nm_imagem != '') {
            $imagens = explode('|',$produto->nm_imagem);
        }

        $produto->imagens_json = json_encode($imagens);
        $produto->inserido = $this->formataDataExibicao($produto->updated_at);

        return view('site/visualizarProduto',[
            'produto'=>$produto,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    public function getFiltro(Request $request)
    {
        if (count($request->parametro) > 0) {
            foreach ($request->parametro as $key => $value) {
                $parametros[$key] = explode(',',$value);
            }
            $this->model->parametros = $parametros;
        }

        $retorno = $this->model->mountFilter();

        echo response()->json($retorno)->content();
        die();
    }

}
