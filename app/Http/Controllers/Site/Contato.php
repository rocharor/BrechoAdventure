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

    /**
     * Salvo os dados de contato no banco de dados e manda email
     *
     * @param unknown $dados
     */
    public function salvaContatoAction()
    {
        $dados = $_POST;

        $retorno = $this->model->setMensagem($dados);
		
        return view('site/contato',['logado'=>0,'msg'=>$retorno]);

        // if ($retorno) {
        //     $msg = '<div class="alert alert-success" align="center" style="width: 400px;">Mensagem enviada com sucesso</div>';
        //     $emailModel = new EmailModel();
        //     $emailModel->respAutomaticaContato($dados['nome'], $dados['email']);
        // } else {
        //     $msg = '<div class="alert alert-danger" align="center" style="width: 400px;">Erro ao enviar a mensagem</div>';
        // }
        //
        // $variaveis = [
        //     'active_3' => 'active',
        //     'msg' => $msg
        // ];
    }
}
