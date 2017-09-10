<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\Site\Produto;

class ProductController extends Controller
{

    public $model;
    public $dataTop;

    public function __construct(DashboardController $dashboard, Produto $produto)
    {
        $this->model = $produto;
        $this->dataTop = $dashboard->dashboard();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->dataTop;

        return view('admin/contents/listProducts', [
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->dataTop;

        $produto_id = (int) $id;
        $produto = $this->model->getProduto($produto_id);

        $produto->imagens = explode('|',$produto->nm_imagem);;

        $data['produto'] = $produto;

        return view('admin/contents/viewProduct', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            $param[$key] = trim($value);
        }

        // $retorno = $this->model->updateAdmin($request->id, $param);
        $produto = $this->model->find($request->id);
        foreach ($param as $key=>$value) {
            if ($key == '_token' || $key == 'id') {
                continue;
            }
            $produto->$key = $value;
        }

        $retorno = false;
        if ($produto->save()) {
            $retorno =  true;
        }

        if ($retorno) {
            return redirect()->route('admin.pendente.product-list')->with('sucesso','Status do produto alterado com sucesso.');
        }

        return redirect()->route('admin.pendente.product-list')->with('erro','Erro ao atualizar status.');
    }
}
