<?php

namespace App\Data\Repositories\Site;

use Illuminate\Support\Facades\Auth;
use App\Services\Util;
use App\Data\Models\Site\Favorite;


class FavoriteRepository
{
    use Util;

    private $model;
    public $paginacao = false;
    public $pagina = 1;
    public $totalPagina = 8;

    public function __construct(Favorite $model)
    {
        $this->model = $model;
    }

    public function getFavoritos()
    {
        $favoritos = [];
        $total = [];
        if($this->paginacao){
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if($limit['fim']){
                $favoritos = $this->model
                ->where('status',1)
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->offset($limit['fim'])
                ->orderBy('created_at', 'DESC')
                ->get();
            }else{
                $favoritos = $this->model
                ->where('status',1)
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->orderBy('created_at', 'DESC')
                ->get();
            }
            $total = $this->model->where('status',1)->where('user_id',Auth::user()->id)->count();
        }else{
            if(Auth::user()){
                $favoritos = $this->model->where('status',1)
                ->where('user_id', Auth::user()->id)
                ->orderBy('created_at', 'DESC')
                ->get();
            }
        }

        $retorno = [
            'itens' => $favoritos,
            'total' => $total
        ];

        return $retorno;
    }

    public function store($request)
    {
        $user_id = Auth::user()->id;
        $vefificacao = $this->model->where('user_id',$user_id)->where('produto_id',$request->produto_id)->get();

        $status = 1;
        if(count($vefificacao) == 0){
            $this->model->user_id = $user_id;
            $this->model->produto_id = $request->produto_id;
            $this->model->status = $status;
            $retorno = $this->model->save();
        }else{
            if($vefificacao[0]->status == 1){
                $status = 0;
            }

            $retorno = $this->update($request->produto_id, $status);
        }

        if($retorno){
            echo response()->json([
                'success' => 1,
                'produto_id' => $request->produto_id,
                'status' => $status
            ])->content();
            die();
        }
        echo 0;
        die();
    }

    public function update($produto_id,$status)
    {
        $produto = $this->model->where('produto_id',$produto_id)->get();
        $produto[0]->status = $status;
        $retorno = $produto[0]->save();

        return $retorno;
    }

    public function delete($request)
    {
        $favorito_id = $request->id;
        $favorito = $this->model->find($favorito_id);

        if ($favorito->delete()) {
            return redirect()->route('minha-conta.meus-favorito',1)->with('sucesso','Favorito excluido com sucesso.');
        }

        return redirect()->route('minha-conta.meus-favorito',1)->with('erro','Erro ao excluir favorito.');
    }

}
