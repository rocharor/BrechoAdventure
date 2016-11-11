<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //dd($_COOKIE);
        //$frase = $this->model->frasesHome();
        // return view('site/home',['logado'=>0,'frase'=>$frase]);
        return view('home');
    }
}
