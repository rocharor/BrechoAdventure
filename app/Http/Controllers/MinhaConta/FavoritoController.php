<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $this->model->user_id = $request->user_id;
        $this->model->produto_id = $request->produto_id;
        $this->model->status = $request->status;
        $this->model->save();
        echo 1;
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
