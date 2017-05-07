<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Favorito as FavoritoModel;

class FavoritoController extends Controller
{
    private $model;

    public function __construct(FavoritoModel $objFavorito)
    {
        $this->model = $objFavorito;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favoritos = $this->model->getFavoritos();
        foreach($favoritos as $key=>$favorito){
            $arrImg = explode('|',$favorito->produto->nm_imagem);
            $favorito->produto->imgPrincipal = $arrImg[0];
            $favorito->produto->idCodificado = base64_encode($favorito->id);
        }

        return view('minhaConta/favorito',['favoritos'=>$favoritos]);
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
}
