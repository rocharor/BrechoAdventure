<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Message;
use App\Models\Site\Product;
use App\Models\Site\Conversa;

class MessageController extends Controller
{

    public $model;

    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function index()
    {
        $conversas_enviadas = $this->model->buscaConversasEnviadas();
        $conversas_recebidas = $this->model->buscaConversasRecebidas();

        $qtdConversasEnviadas = $conversas_enviadas['naoLidas'];
        $qtdConversasRecebidas = $conversas_recebidas['naoLidas'];
        unset($conversas_enviadas['naoLidas']);
        unset($conversas_recebidas['naoLidas']);

        return view('minhaConta/message',[
            'conversas_enviadas'=>$conversas_enviadas,
            'conversas_recebidas'=>$conversas_recebidas,
            'qtdConversasEnviadas'=>$qtdConversasEnviadas,
            'qtdConversasRecebidas'=>$qtdConversasRecebidas,
            'breadCrumb' => $this->getBreadCrumb()
            ]
        );
    }

    public function create(Request $request,Product $produto)
    {
        try {
            $produto_id = (int)$request->get('produto_id');

            $dados = $produto->getProduto($produto_id);
            $dados['name'] = $dados->user->name;
            $dados['nome_remet'] = Auth::user()->name;

            return response($dados, 200);
        } catch(\Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    public function store(Request $request, Product $produto, Conversa $conversa)
    {
        $produto_id = $request->get('produto_id');
        $mensagem = $request->get('mensagem');
        $user_id_envio = Auth::user()->id;
        $user_id_destino = $produto->find($produto_id)->user_id;

        $conversa->user_id_envio = $user_id_envio;
        $conversa->user_id_destino = $user_id_destino;
        $conversa->produto_id = $produto_id;

        $code = 400;
        if($conversa->save()) {
            $this->model->conversa_id = $conversa->id;
            $this->model->user_id_envio = $user_id_envio;
            $this->model->user_id_destino = $user_id_destino;
            $this->model->mensagem = $mensagem;
            if ($this->model->save()) {
                $code = 201;
            }
        };

        return response('', $code);
    }

    public function update(Request $request, Conversa $conversa)
    {
        $user = Auth::user();
        $conversa_id = $request->conversa_id;
        $user_id_envio = $user->id;
        $mensagem = $request->resposta;

        $dados = $conversa->find($conversa_id)->select('user_id_envio','user_id_destino')->get();
        $user_id_destino = ($dados[0]->user_id_envio == $user_id_envio) ? $dados[0]->user_id_destino : $dados[0]->user_id_envio;

        $this->model->conversa_id = $conversa_id;
        $this->model->user_id_envio = $user_id_envio;
        $this->model->user_id_destino = $user_id_destino;
        $this->model->mensagem = $mensagem;

        $dados = [];
        if ($this->model->save()) {
            $dados['nome'] = $user->name;
            $dados['mensagem'] = $this->model->mensagem;
            $dados['data'] = $this->model->created_at;
            return redirect()->route('minha-conta.mensagem')->with('sucesso','Mensagem enviada com sucesso.');
        }

        return redirect()->route('minha-conta.mensagem')->with('erro','Erro ao enviar a mensagem!');
    }

    public function delete(Request $request, Conversa $conversa)
    {
        $conversa_id = (int)$request->conversa_id;

        $code = 400;
        if ($conversa->find($conversa_id)->delete()){
            if ($this->model->where('conversa_id',$conversa_id)->delete()){
                $code = 200;
            }
        }

        return response('', $code);
    }

    // public function buscaNotificacao()
    // {
    //     if (Auth::user()){
    //         $user_id = Auth::user()->id;
    //         $mensagens = $this->model->where(['lido'=>0,'user_id_destino'=>$user_id])->select('id')->get();

    //         echo count($mensagens);
    //         die();
    //     }
    // }

    // public function updateNotificacao(Request $request)
    // {
    //     $user_id = Auth::user()->id;
    //     $conversa_id = $request->get('conversa_id');
    //     $mensagens = $this->model->where(['conversa_id'=>$conversa_id,'user_id_destino'=>$user_id])->update(['lido'=>1]);

    // }
}