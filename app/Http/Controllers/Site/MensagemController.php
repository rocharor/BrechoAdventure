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
    public function index(Conversa $conversa)
    {
        $user_id = Auth::user()->id;
        $dados = $conversa->where('user_id_envio',$user_id)->select('id')->get();

        dd($dados);

        return view('minhaConta/mensagem');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Produto $produto, Conversa $conversa)
    {
        $produto_id = $request->get('produto_id');
        $mensagem = $request->get('mensagem');
        $user_id_envio = Auth::user()->id;
        $user_id_destino = $produto->find($produto_id)->user_id;

        $conversa->user_id_envio = $user_id_envio;
        $conversa->user_id_destino = $user_id_destino;
        $conversa->produto_id = $produto_id;
        if($conversa->save()) {
            $this->model->conversa_id = $conversa->id;
            $this->model->user_id = $user_id_envio;
            $this->model->mensagem = $mensagem;
            if ($this->model->save()) {
                return redirect()->route('produto')->with('sucesso','Mensagem enviada com sucesso.');
            }
        };

        return redirect()->route('produto')->with('erro','Erro ao enviar mensagem, tente novamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Produto $produto)
    {
        $produto_id = $request->get('produto_id');

        $dados = $produto->getDescricaoProduto($produto_id);
        $dados['nome_remet'] = Auth::user()->name;

        echo response()->json($dados)->content();
        die();
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
    public function update(Request $request, $id)
    {
        //
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
}
