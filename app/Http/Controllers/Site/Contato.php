<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Contato extends Controller
{
    public function indexAction()
    {        
      return view('site/contato',['logado'=>0]);
    }
}
