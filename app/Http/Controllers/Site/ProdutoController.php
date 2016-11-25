<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Produto as ProdutoModel;
use App\Models\User;

class ProdutoController extends Controller
{
    public $model;

    public function __construct(ProdutoModel $produto)
    {
        $this->model = $produto;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = $this->model->getProdutos(9);
        foreach($produtos as $produto){
            $img = $produto->nm_imagem;
            $arrImg = explode('|',$img);
            $produto->imgPrincipal = $arrImg[0];
        }

        return view('site/produto',['produtos'=>$produtos]);
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
