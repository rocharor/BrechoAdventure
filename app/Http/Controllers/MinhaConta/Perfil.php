<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MinhaConta\Perfil as PerfilModel;

class Perfil extends Controller
{
    private $model;

    public function __construct(PerfilModel $objPerfil)
    {
        $this->middleware('auth');
        $this->model = $objPerfil;
    }

    public function indexAction()
    {
        return view('minhaConta/perfil');
    }

    public function updatePerfil()
    {
        $dados = $_POST;

        $this->model->salvarPerfil($dados);
        dd($dados);
    }
}
