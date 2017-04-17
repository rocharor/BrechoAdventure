<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Contato as ContatoModel;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BrechoMail;

class ContatoController extends Controller
{
    public $model;

    public function __construct(ContatoModel $contato)
    {
        $this->model = $contato;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site/contato');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required',
            'tipo' => 'required',
            //unique:contatos
        ]);

        $dados = $request->all();
        $dados['categoria'] = Categoria::find($dados['tipo'])->categoria;
        $retorno = $this->model->setMensagem($dados);
        if($retorno){
            Mail::to($dados['email'])->send(new BrechoMail(1, $dados));
            return redirect()->route('contato')->with('sucesso','Salvo com sucesso!');
        }else{
            return redirect()->route('contato')->with('erro','Erro ao salvar, tente novamente!');
        }
    }
}
