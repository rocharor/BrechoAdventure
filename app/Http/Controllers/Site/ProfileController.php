<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\UploadImagem;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use UploadImagem;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = DB::table('estados')->pluck('nome','sigla');

        Auth::user()->dt_nascimento = preg_replace("/([0-9]*)-([0-9]*)-([0-9]*)/", "$3/$2/$1", Auth::user()->dt_nascimento);

        return view('minhaConta/profile',[
            'estados'=>$estados,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }

    /**
     * Atualiza dados do usuário
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
        Auth::user()->dt_nascimento = $this->formataDataBD($request->dt_nascimento,false);
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
            return redirect()->route('minha-conta.profile')->with('flashMessage', [
                    'message' => 'Dados salvos com sucesso.',
                    'type' => 'success'
                ]
            );
        }

        return redirect()->route('minha-conta.profile')->with('flashMessage', [
            'message' => 'Erro ao alterar imagem , tente novamente!',
            'type' => 'danger'
        ]);
    }

    /**
     * Atualiza foto do perfil do usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFoto(Request $request)
    {
        if ($request->hasFile('imagemCrop') && $request->file('imagemCrop')->isValid() && $request->h > 0 && $request->w > 0){
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
                    return 1;
                }
            }
        }
        return 0;
    }

    /**     
     *Método para alterar a senha do susuário 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)){
            if ($request->new_password === $request->confirm_password) {
                Auth::user()->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();

                return redirect()->route('minha-conta.profile')->with('flashMessage', [
                    'message' => 'Senha alterada com sucesso.',
                    'type' => 'success'
                ]);
            }else{
                return redirect()->route('minha-conta.profile')->with('flashMessage', [
                    'message' => 'As senhas novas não conferem.',
                    'type' => 'danger'
                ]);
            }
        }else{
            return redirect()->route('minha-conta.profile')->with('flashMessage', [
                'message' => 'Senha atual incorreta.',
                'type' => 'danger'
            ]);
        }
    }
}
