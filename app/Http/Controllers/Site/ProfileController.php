<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Data\Repositories\Site\ProfileRepository;
// use App\Models\User;
use App\Services\UploadImagem;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use UploadImagem;

    public function __construct(ProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = DB::table('estados')->pluck('nome', 'sigla');

        Auth::user()->dt_nascimento = preg_replace("/([0-9]*)-([0-9]*)-([0-9]*)/", "$3/$2/$1", Auth::user()->dt_nascimento);

        return view('minhaConta/profile', [
            'estados' => $estados,
            'breadCrumb' => $this->getBreadCrumb()
        ]);
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:255',
            'email' => 'required',
            'dt_nascimento' => 'required'
        ]);

        $id = Auth::user()->id;
        $response = $this->repository->update($id, $request->all());

        if ($response) {
            return redirect()->route('minha-conta.profile')->with(
                'flashMessage',
                [
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

    public function updatePhoto(Request $request)
    {

        if ($request->hasFile('imagemCrop') && $request->file('imagemCrop')->isValid() && $request->h > 0 && $request->w > 0) {

            $id = Auth::user()->id;
            $response = $this->repository->updatePhoto($id, $request->all());

            if ($response) {
                return 1;
            }
        }

        return 0;
    }

    public function updatePassword(Request $request)
    {
        if (Hash::check($request->old_password, Auth::user()->password)){
            if ($request->new_password === $request->confirm_password) {
                $response = $this->repository->updatePassword(Auth::user()->id, Hash::make($request->new_password));

                if ($response == 1) {
                    return redirect()->route('minha-conta.profile')->with('flashMessage', [
                        'message' => 'Senha alterada com sucesso.',
                        'type' => 'success'
                    ]);
                }

                return redirect()->route('minha-conta.profile')->with('flashMessage', [
                    'message' => 'Erro ao alterar senha.',
                    'type' => 'danger'
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
