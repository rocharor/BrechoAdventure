<?php

namespace App\Http\Controllers\MinhaConta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Perfil extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAction()
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

        return view('minhaConta/perfil',['estados'=>$estados]);
    }

    public function updatePerfilAction(User $user, Request $request)
    {
        $dados = $request->get('dados');
        $r = $user->find(Auth::user()->id);

        $retorno =  $r->update($dados);

        echo response()->json($retorno)->content();
        die();

    }

    public function updateFotoAction(User $user, Request $request)
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
            }
        //
        //     echo json_encode($retorno);
        //     exit();
    }
}
