<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MinhaConta\Favorito as FavoritoModel;

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
            $img = $favorito->produto->nm_imagem;
            $arrImg = explode('|',$img);
            $favorito->produto->imgPrincipal = $arrImg[0];
        }

        return view('minhaConta/favorito',['favoritos'=>$favoritos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $vefificacao = $this->model->where('user_id',$user_id)->where('produto_id',$request->produto_id)->get();

        if(count($vefificacao) == 0){
            // $this->model->user_id = $request->user_id;
            $this->model->user_id = $user_id;
            $this->model->produto_id = $request->produto_id;
            $this->model->status = $request->status;
            $retorno = $this->model->save();
        }else{
            $retorno = $this->update($request->produto_id,$request->status);
        }

        if($retorno){
            echo 1;
            die();
        }
        echo 0;
        die();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update($produto_id,$status)
    {
        $produto = $this->model->where('produto_id',$produto_id)->get();
        $produto[0]->status = $status;
        $retorno = $produto[0]->save();

        return $retorno;
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
