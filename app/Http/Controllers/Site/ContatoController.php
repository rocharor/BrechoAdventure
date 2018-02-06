<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use App\Models\Site\Contato as ContatoModel;
use App\Models\Categoria;
use App\Mail\BrechoMail;
use App\Events\sendEmailAdmin;

class ContatoController extends Controller
{
    public $model;

    public function __construct(ContatoModel $contato)
    {
        $this->model = $contato;
    }

    public function index()
    {
        $data['tipos'] = $this->getTipoContato();

        return view('site/contato',[
            'breadCrumb' => $this->getBreadCrumb(),
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'tipo' => 'required',
        ]);

        $dados = $request->all();

        $dados['tipo'] = $this->getTipoContato($dados['tipo']);
        $retorno = $this->model->setMensagem($dados);

        if($retorno){
            Mail::to($dados['email'])->send(new BrechoMail(1, $dados));
            event(new sendEmailAdmin());

            return redirect()->route('contato')->with('sucesso','Enviado com sucesso!');
        }else{
            return redirect()->route('contato')->with('erro','Erro ao enviar, tente novamente!');
        }
    }
}
