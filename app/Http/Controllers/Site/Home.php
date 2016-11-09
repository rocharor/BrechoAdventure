<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Home;

class Home extends Controller
{
    public $model;

    public function __construct(Home $objHome)
    {
        $this->model = $objHome;
    }

    public function indexAction(Frases $objFrases)
    {
        $frase = $this->model->frasesHome();
        return view('site/home',['logado'=>0,'frase'=>$frase]);
    }
}
