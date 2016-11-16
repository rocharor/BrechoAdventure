<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Favorito extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAction()
    {
        return view('minhaConta/favorito');
    }
}
