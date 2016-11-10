<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Home as HomeModel;

class Home extends Controller
{
    public $model;

    public function __construct(HomeModel $objHome)
    {
        $this->model = $objHome;
    }

    public function indexAction()
    {
        $frase = $this->model->frasesHome();
        return view('site/home',['logado'=>0,'frase'=>$frase]);
    }
}
