<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Favorito;
use App\Models\Robo;

class FavoritoController extends Controller
{
    private $model;

    public function __construct(Favorito $favorito)
    {
        $this->model = $favorito;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pagina=1)
    {
        $this->model->paginacao = true;
        $this->model->pagina = $pagina;
        $favoritos = $this->model->getFavoritos();
        foreach($favoritos['itens'] as $key=>$favorito){
            $favorito->produto->imgPrincipal = $this->imagemPrincipal($favorito->produto->nm_imagem);
        }

        $numberPages = (int)ceil($favoritos['total'] / $this->model->totalPagina);

        return view('minhaConta/favorito',[
            'favoritos' => $favoritos['itens'],
            'breadCrumb' => $this->getBreadCrumb(),
            'pg' => $pagina,
            'numberPages' => $numberPages,
            'link' => '/minha-conta/favorito/'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $vefificacao = $this->model->where('user_id',$user_id)->where('produto_id',$request->produto_id)->get();

        $status = 1;
        if(count($vefificacao) == 0){
            $this->model->user_id = $user_id;
            $this->model->produto_id = $request->produto_id;
            $this->model->status = $status;
            $retorno = $this->model->save();
        }else{
            if($vefificacao[0]->status == 1){
                $status = 0;
            }

            $retorno = $this->update($request->produto_id, $status);
        }

        if($retorno){
            echo response()->json([
                'success' => 1,
                'produto_id' => $request->produto_id,
                'status' => $status
            ])->content();
            die();
        }
        echo 0;
        die();
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($produto_id,$status)
    {
        $produto = $this->model->where('produto_id',$produto_id)->get();
        $produto[0]->status = $status;
        $retorno = $produto[0]->save();

        return $retorno;
    }

    public function delete(Request $request)
    {
        $favorito_id = $request->id;
        $favorito = $this->model->find($favorito_id);

        if ($favorito->delete()) {
            return redirect()->route('minha-conta.meus-favorito',1)->with('sucesso','Favorito excluido com sucesso.');
        }
        return redirect()->route('minha-conta.meus-favorito',1)->with('erro','Erro ao excluir favorito.');
    }
}
