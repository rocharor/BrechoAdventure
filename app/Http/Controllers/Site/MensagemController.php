<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Mensagem;
use App\Models\Site\Produto;

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
        $user_id = Auth::user()->id;
        $mensagens = $this->model->where('user_id_remet',$user_id)->get();
        dd($mensagens);
        return view('minhaConta/mensagem');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Produto $produto)
    {
        $produto_id = $request->get('produto_id');
        $mensagem = $request->get('mensagem');
        $user_id_remet = Auth::user()->id;
        $user_id_dest = $produto->find($produto_id)->user_id;

        $this->model->user_id_dest = $user_id_dest;
        $this->model->produto_id = $produto_id;
        $this->model->user_id_remet = $user_id_remet;
        $this->model->mensagem = $mensagem;

        if ($this->model->save()) {
            return redirect()->route('produto')->with('sucesso','Mensagem enviada com sucesso.');
        }
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
