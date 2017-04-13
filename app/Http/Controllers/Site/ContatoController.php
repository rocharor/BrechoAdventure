<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Contato as ContatoModel;
// use App\Services\Email;
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
    public function store(Request $request, Email $email)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required',
            'tipo' => 'required',
            //unique:contatos
        ]);

        $dados = $request->all();
        $retorno = $this->model->setMensagem($dados);
        if($retorno){
            // $email->respAutomaticaContato($dados['nome'],$dados['email']);
            Mail::to(Auth::user())->send(new BrechoMail(1, Auth::user()));
            return redirect()->route('contato')->with('sucesso','Salvo com sucesso!');
        }else{
            return redirect()->route('contato')->with('erro','Erro ao salvar, tente novamente!');
        }
    }
}
