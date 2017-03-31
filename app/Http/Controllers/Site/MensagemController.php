<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Mensagem;
use App\Models\Site\Produto;
use App\Models\Site\Conversa;

class MensagemController extends Controller
{

    public $model;

    public function __construct(Mensagem $mensagem)
    {
        $this->model = $mensagem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversas_enviadas = $this->model->buscaConversasEnviadas();
        $conversas_recebidas = $this->model->buscaConversasRecebidas();

        $qtdConversasEnviadas = $conversas_enviadas['naoLidas'];
        $qtdConversasRecebidas = $conversas_recebidas['naoLidas'];
        unset($conversas_enviadas['naoLidas']);
        unset($conversas_recebidas['naoLidas']);

        return view('minhaConta/mensagem',[
            'conversas_enviadas'=>$conversas_enviadas,
            'conversas_recebidas'=>$conversas_recebidas,
            'qtdConversasEnviadas'=>$qtdConversasEnviadas,
            'qtdConversasRecebidas'=>$qtdConversasRecebidas,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Produto $produto)
    {
        $produto_id = $request->get('produto_id');

        $dados = $produto->getDescricaoProduto($produto_id);
        $dados['nome_remet'] = Auth::user()->name;

        echo response()->json($dados)->content();
        die();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produto $produto, Conversa $conversa)
    {

        $produto_id = $request->get('produto_id');
        $mensagem = $request->get('mensagem');
        $user_id_envio = Auth::user()->id;
        $user_id_destino = $produto->find($produto_id)->user_id;

        $conversa->user_id_envio = $user_id_envio;
        $conversa->user_id_destino = $user_id_destino;
        $conversa->produto_id = $produto_id;

        $retorno = ['success'=>0];
        if($conversa->save()) {
            $this->model->conversa_id = $conversa->id;
            $this->model->user_id_envio = $user_id_envio;
            $this->model->user_id_destino = $user_id_destino;
            $this->model->mensagem = $mensagem;
            if ($this->model->save()) {
                // return redirect()->route('todosProdutos',1)->with('sucesso','Mensagem enviada com sucesso.');
                $retorno = ['success'=>1];
            }
        };
        // return redirect()->route('todosProdutos',1)->with('erro','Erro ao enviar mensagem, tente novamente!');
        echo response()->json($retorno)->content();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Conversa $conversa)
    {
        $user = Auth::user();
        $conversa_id = $request->get('conversa_id');
        $user_id_envio = $user->id;
        $mensagem = $request->get('mensagem');

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
        }

        echo response()->json($dados)->content();
        die();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscaNotificacao()
    {
        if (Auth::user()){
            $user_id = Auth::user()->id;
            $mensagens = $this->model->where(['lido'=>0,'user_id_destino'=>$user_id])->select('id')->get();

            echo count($mensagens);
            die();
        }
    }

    public function updateNotificacao(Request $request)
    {
        $user_id = Auth::user()->id;
        $conversa_id = $request->get('conversa_id');
        $mensagens = $this->model->where(['conversa_id'=>$conversa_id,'user_id_destino'=>$user_id])->update(['lido'=>1]);

    }
}
