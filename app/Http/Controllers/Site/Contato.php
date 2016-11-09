<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Contato extends Controller
{
    public $model;

    public function __construct(Contato $contato)
    {
        $this->model = $contato;
    }

    public function indexAction()
    {
        return view('site/contato',['logado'=>0]);
    }
}
