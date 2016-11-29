<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto as ProdutoModel;
use App\Models\Site\Favorito;
use App\Services\Util;

class ProdutoController extends Controller
{
    use Util;

    public $model;
    public $totalPagina = 5;

    public function __construct(ProdutoModel $produto)
    {
        $this->model = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Favorito $favorito)
    {
        $produtos = $this->model->getProdutos(9);
        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/produto',['produtos'=>$produtos]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todosProdutosIndex($pg, Favorito $favorito)
    {
        $totalProdutos = count($this->model->getProdutos());
        $paginacao = (int)ceil($totalProdutos / $this->totalPagina);

        $limit = Util::geraLimitPaginacao($pg,$this->totalPagina);
        $produtos = $this->model->getProdutos($limit['inicio'],$limit['fim']);
        $favoritos = $favorito->getFavoritos();
        foreach($produtos as $produto){
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $produto->favorito = false;
            foreach($favoritos as $favorito){
                if($favorito->produto_id == $produto->id){
                    $produto->favorito = true;
                }
            }
        }

        return view('site/todosProdutos',['produtos'=>$produtos,'pg'=>$pg,'totalProdutos'=>$paginacao]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMC()
    {
        return view('minhaConta/produto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Traz os dados do produto
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $produto_id = $request->get('produto_id');
        $produtos = $this->model->getDescricaoProduto($produto_id);

        //echo response($produtos)->content();
        echo response()->json($produtos)->content();
        die();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
