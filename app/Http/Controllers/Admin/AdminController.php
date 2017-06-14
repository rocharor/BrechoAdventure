<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Site\Produto;
use App\Models\Robo;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $arrQtdHome = $this->model->buscaQuantidadeHome();
        return view('admin/home');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLTE()
    {
        return view('admin/AdminLTE/index');
    }

    public function updateCacheProducts(Robo $robo)
    {
        $robo->mountFilterCache();

        return redirect()->route('admin.home')->with('sucesso','Cache atualizado com sucesso.');        
    }
}
