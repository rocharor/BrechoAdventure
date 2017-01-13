<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\Contato as ContatoModel;
use App\Services\Email;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            return redirect()->route('contato')->with('sucesso','Salvo com sucesso!');
        }else{
            return redirect()->route('contato')->with('erro','Erro ao salvar, tente novamente!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
