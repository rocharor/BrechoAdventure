<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frases;

class Home extends Controller
{
    public function indexAction(Frases $objFrases)
    {
      $frase = $objFrases->getFrases();
      return view('site/home',['logado'=>0,'frase'=>$frase]);
    }
}
