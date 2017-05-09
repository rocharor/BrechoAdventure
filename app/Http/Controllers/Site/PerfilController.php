<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use File;
use App\Models\User;
use App\Services\Util;
// use App\Services\Upload;
use App\Services\UploadImagem;
use DB;

class PerfilController extends Controller
{
    // use Util,Upload;
    use Util,UploadImagem;

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
        $estados = DB::table('estados')->pluck('nome','sigla');

        Auth::user()->dt_nascimento = preg_replace("/([0-9]*)-([0-9]*)-([0-9]*)/", "$3/$2/$1", Auth::user()->dt_nascimento);

        return view('minhaConta/perfil',['estados'=>$estados]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required',
            'dt_nascimento' => 'required'
        ]);

        Auth::user()->name = $request->nome;
        Auth::user()->email = $request->email;
        Auth::user()->dt_nascimento = Util::formataDataBD($request->dt_nascimento,false);
        Auth::user()->cep = $request->cep;
        Auth::user()->endereco = $request->endereco;
        Auth::user()->numero = $request->numero;
        Auth::user()->complemento = $request->complemento;
        Auth::user()->bairro = $request->bairro;
        Auth::user()->cidade = $request->cidade;
        Auth::user()->uf = $request->uf;
        Auth::user()->telefone_cel = str_replace(['(',')','-'], '', $request->telefone_cel);
        Auth::user()->telefone_fixo = str_replace(['(',')','-'], '', $request->telefone_fixo);

        $retorno = Auth::user()->save();

        if($retorno){
            return redirect()->route('minha-conta.perfil')->with('sucesso','Dados salvos com sucesso.');
        }

        return redirect()->route('minha-conta.perfil')->with('erro','Erro ao alterar imagem , tente novamente!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFoto(Request $request)
    {
        if ($request->hasFile('imagemCrop') && $request->file('imagemCrop')->isValid() && $request->h > 0 && $request->w > 0){
            // $novoNome = $this->salvarFotoRedimensionado($request->imagemCrop, 'imagens/cadastro/',  $request->h, $request->w, $request->x, $request->y);
            $this->w = $request->w;
            $this->h = $request->h;
            $this->x = $request->x;
            $this->y = $request->y;
            $novoNome = $this->imagemPerfil($request->imagemCrop);

            if ($novoNome) {
                if (Auth::user()->nome_imagem != 'sem-imagem.jpg') {
                    $this->deleteImagemPerfil(Auth::user()->nome_imagem);
                }

                $ret =  Auth::user()->update(['nome_imagem'=>$novoNome]);
                if ($ret) {
                    return redirect()->route('minha-conta.perfil')->with('sucesso','Foto alterada com sucesso.');
                }
            }
        }
        return redirect()->route('minha-conta.perfil')->with('erro','Erro ao alterar imagem , tente novamente!');

        /*
        // $arquivo_file = $request->file('imagemPerfil');
        $foto_salva = false;
        if ($request->hasFile('imagemPerfil') && $request->file('imagemPerfil')->isValid()){
            $ext = $request->imagemPerfil->extension();
            if($this->validaExtImagem($ext)){
                // $path = $request->imagemPerfil->store('imagens/cadastro'); //envia as imagens para a pasta Storage/app
                // $path = $request->imagemPerfil->storeAs('imagens/cadastro', $foto_nome); // mesma coisa só que pode setar o nome
                $foto_nome = Auth::user()->id . '_' . date('d-m-Y_h_i_s') . '.' . $ext;
                $foto_salva = $request->imagemPerfil->move(public_path("imagens/cadastro"), $foto_nome);
            }
        }

        if ($foto_salva) {
            $imagemAntiga = Auth::user()->nome_imagem;
            if($imagemAntiga != 'padrao.jpg'){
                $filename = public_path("imagens\cadastro\\" . $imagemAntiga);
                File::delete($filename);
            }

            $r = $user->find(Auth::user()->id);
            $ret =  $r->update(['nome_imagem'=>$foto_nome]);
                if ($ret) {
                    return redirect()->route('minha-conta.perfil')->with('sucesso','Foto alterada com sucesso.');
                }
        }

        return redirect()->route('minha-conta.perfil')->with('erro','Erro ao alterar imagem , tente novamente!');
        // return redirect()->action('MinhaConta\PerfilController@index', $retorno);
        */
    }
}
