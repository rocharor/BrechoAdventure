<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Site\Produto;
use App\Models\User;
use App\Services\Util;


class Favorito extends Model
{
    use SoftDeletes, Util;

    protected $table = 'favoritos';
    protected $dates = ['deleted_at'];
    public $paginacao = false;
    public $pagina = 1;
    public $totalPagina = 8;

    public function produto()
    {
        return $this->belongsTo(Produto::class);
        // Uso: $f->find(1)->produto
        // Retorno: O produto que este favorito pertence (id=1) coluna "id" da tabela "produto"
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // Uso: $f->find(1)->user
        // Retorno: O user que este favorito pertence (id=1) coluna "id" da tabela "user"
    }

    public function getFavoritos()
    {
        $favoritos = [];
        $total = [];
        if($this->paginacao){
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if($limit['fim']){
                $favoritos = $this->where('status',1)
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->offset($limit['fim'])
                ->orderBy('created_at', 'DESC')
                ->get();
            }else{
                $favoritos = $this->where('status',1)
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->orderBy('created_at', 'DESC')
                ->get();
            }
            $total = $this->where('status',1)->where('user_id',Auth::user()->id)->count();
        }else{
            if(Auth::user()){
                $favoritos = $this->where('status',1)
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

}
