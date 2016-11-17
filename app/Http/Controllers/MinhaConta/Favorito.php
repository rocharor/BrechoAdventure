<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MinhaConta\Favorito as FavoritoModel;

class Favorito extends Controller
{
    private $model;

    public function __construct(FavoritoModel $objFavorito)
    {
        $this->middleware('auth');
        $this->model = $objFavorito;
    }

    public function indexAction()
    {
        dd(Auth::user());
        return view('minhaConta/favorito');
    }
}
