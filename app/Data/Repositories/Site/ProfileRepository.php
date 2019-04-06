<?php

namespace App\Data\Repositories\Site;

use App\Data\Models\User;
// use Illuminate\Support\Facades\Auth;
use App\Services\Util;
use App\Services\UploadImagem;

class ProfileRepository
{
    use Util, UploadImagem;

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Atualiza dados do usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, array $params)
    {
        $response = $this->model
            ->find($id)
            ->update([
                'name' => $params['nome'],
                'email' => $params['email'],
                'dt_nascimento' => $this->formataDataBD($params['dt_nascimento'],false),
                'cep' => $params['cep'],
                'endereco' => $params['endereco'],
                'numero' => $params['numero'],
                'complemento' => $params['complemento'],
                'bairro' => $params['bairro'],
                'cidade' => $params['cidade'],
                'uf' => $params['uf'],
                'telefone_cel' => str_replace(['(',')','-'], '', $params['telefone_cel']),
                'telefone_fixo' => str_replace(['(',')','-'], '', $params['telefone_fixo']),
            ]);

        return $response;
    }

    /**
     * Atualiza foto do perfil do usuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(int $id, array $params)
    {
            $this->w = $params['w'];
            $this->h = $params['h'];
            $this->x = $params['x'];
            $this->y = $params['y'];

            $novoNome = $this->imagemPerfil($params['imagemCrop']);

            if ($novoNome) {
                $user = $this->model->find($id);

                if ($user->nome_imagem != 'sem-imagem.jpg') {
                    $this->deleteImagemPerfil($user->nome_imagem);
                }

                $response =  $user->update(['nome_imagem'=>$novoNome]);

                if ($response) {
                    return 1;
                }
            }

        return 0;
    }

    /**
     * Método para alterar a senha do susuário
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword($id, $newPassword)
    {
        $response = $this->model
            ->find($id)
            ->update([
                'password' => $newPassword
            ]);

        return $response;

        // Auth::user()->fill([
        //     'password' => Hash::make($request->new_password)
        // ])->save();

    }
}
