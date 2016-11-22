<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use File;
use App\Models\User;
use App\Services\Util;

class PerfilController extends Controller
{
    use Util;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = [
            "AC"=>"Acre",
            "AL"=>"Alagoas",
            "AP"=>"Amapá",
            "AM"=>"Amazonas",
            "BA"=>"Bahia",
            "CE"=>"Ceará",
            "DF"=>"Distrito Federal",
            "ES"=>"Espírito Santo",
            "GO"=>"Goiás",
            "MA"=>"Maranhão",
            "MT"=>"Mato Grosso",
            "MS"=>"Mato Grosso do Sul",
            "MG"=>"Minas Gerais",
            "PA"=>"Pará",
            "PB"=>"Paraíba",
            "PR"=>"Paraná",
            "PE"=>"Pernambuco",
            "PI"=>"Piauí",
            "RJ"=>"Rio de Janeiro",
            "RN"=>"Rio Grande do Norte",
            "RS"=>"Rio Grande do Sul",
            "RO"=>"Rondônia",
            "RR"=>"Roraima",
            "SC"=>"Santa Catarina",
            "SP"=>"São Paulo",
            "SE"=>"Sergipe",
            "TO"=>"Tocantins"
        ];

        Auth::user()->dt_nascimento = preg_replace("/([0-9]*)-([0-9]*)-([0-9]*)/", "$3/$2/$1", Auth::user()->dt_nascimento);

        return view('minhaConta/perfil',['estados'=>$estados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(User $user, Request $request)
    {
        $dados = $request->all();
        unset($dados['_token']);
        $dados['dt_nascimento'] = date("Y-m-d",strtotime(str_replace('/','-',$dados['dt_nascimento'])));
        $dados['cep'] = str_replace('-','',$dados['cep']);
        $dados['telefone_fixo'] = str_replace(['(',')','-'],'',$dados['telefone_fixo']);
        $dados['telefone_cel'] = str_replace(['(',')','-'],'',$dados['telefone_cel']);

        $r = $user->find(Auth::user()->id);
        $retorno =  $r->update($dados);

        if($retorno){
            return redirect()->route('minha-conta.mcperfil')->with('sucesso','Dados salvos com sucesso.');
        }else{
            return redirect()->route('minha-conta.mcperfil')->with('erro','Erro ao alterar imagem , tente novamente!');
        }

        // echo response()->json($retorno)->content();
        // die();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFoto(User $user, Request $request)
    {
        // $arquivo_file = $request->file('imagemPerfil');
        $foto_salva = false;
        if ($request->hasFile('imagemPerfil') && $request->file('imagemPerfil')->isValid()){
            $ext = $request->imagemPerfil->extension();
            if($this->validaExtImagem($ext)){
                // $path = $request->imagemPerfil->store('imagens/cadastro'); /* envia as imagens para a pasta Storage/app*/
                // $path = $request->imagemPerfil->storeAs('imagens/cadastro', $foto_nome); /*mesma coisa só que pode setar o nome*/
                $foto_nome = Auth::user()->id . '_' . date('d-m-Y_h_i_s') . '.' . $ext;
                $foto_salva = $request->imagemPerfil->move(public_path("imagens\cadastro"), $foto_nome);
            }
        }

        if ($foto_salva) {
            $imagemAntiga = Auth::user()->nome_imagem;
            $filename = public_path("imagens\cadastro\\" . $imagemAntiga);
            File::delete($filename);

            $r = $user->find(Auth::user()->id);
            $ret =  $r->update(['nome_imagem'=>$foto_nome]);
                if ($ret) {
                    return redirect()->route('minha-conta.mcperfil')->with('sucesso','Foto alterada com sucesso.');
                }
        }

        return redirect()->route('minha-conta.mcperfil')->with('erro','Erro ao alterar imagem , tente novamente!');
        // return redirect()->action('MinhaConta\PerfilController@index', $retorno);
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
