<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
        $dados = $request->get('dados');
        $dados['dt_nascimento'] = date("Y-m-d",strtotime(str_replace('/','-',$dados['dt_nascimento'])));
        $dados['cep'] = str_replace('-','',$dados['cep']);
        $dados['telefone_fixo'] = str_replace(['(',')','-'],'',$dados['telefone_fixo']);
        $dados['telefone_cel'] = str_replace(['(',')','-'],'',$dados['telefone_cel']);

        $r = $user->find(Auth::user()->id);

        $retorno =  $r->update($dados);

        echo response()->json($retorno)->content();
        die();
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
        //$arquivo_file = $request->file('arquivo');
        $arquivo_file = $request->file('imagemPerfil');
dd($arquivo_file);
        if (
            // Padrao::validaExtImagem([$arquivo_file])
            1) {
            // $usuario_id = Sessao::pegaSessao('logado');

            $arrNomeFoto = explode('.', $arquivo_file['name']);
            $extencao = end($arrNomeFoto);
            $foto_nome = Auth::user()->id . '_' . date('d-m-Y_h_i_s') . '.' . $extencao;

            dd(move_uploaded_file($arquivo_file['tmp_name'], config('app._IMAGENS_') . '\cadastro\\' . $foto_nome));

            if (move_uploaded_file($arquivo_file['tmp_name'], config('app._IMAGENS_') . '\cadastro\\' . $foto_nome)){
                $foto_salva = true;
            }else{
                $foto_salva = false;
            }
        //
        //     if ($foto_salva) {
        //         $user_id = Sessao::pegaSessao('logado');
        //         $ret = $this->model->updateUsuario($user_id, '', $foto_nome);
        //
        //         if ($ret) {
        //             $nome_imagem = Sessao::pegaSessao('nome_imagem');
        //             if ($nome_imagem != 'padrao.jpg')
        //                 unlink(_IMAGENS_ . 'cadastro/' . $nome_imagem);
        //             Sessao::setaSessao(array(
        //                 'nome_imagem' => $foto_nome
        //             ));
        //
        //             $retorno = array(
        //                 'sucesso' => true,
        //                 'mensagem' => 'Foto alterada com sucesso.'
        //             );
        //         } else {
        //             $retorno = array(
        //                 'sucesso' => false,
        //                 'mensagem' => 'Erro ao alterar imagem , tente novamente! cod-U1'
        //             );
        //         }
        //     } else {
        //         $retorno = array(
        //             'sucesso' => false,
        //             'mensagem' => 'Erro ao alterar imagem , tente novamente!'
        //         );
            // }
        //
        //     echo json_encode($retorno);
        //     exit()
        }
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
