<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Contato as ContatoModel;

class Contato extends Controller
{
    public $model;

    public function __construct(ContatoModel $contato)
    {
        $this->model = $contato;
    }

    public function indexAction()
    {
        return view('site/contato',['logado'=>0]);
    }

    public function salvaContatoAction()
    {
        dd($_POST);
    }
}
