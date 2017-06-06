<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Site\Favorito;
use App\Models\Categoria;
use App\Services\Util;

class Produto extends Model
{
    use SoftDeletes, Util;

    protected $table = 'produtos';
    protected $dates = ['deleted_at'];
    public $paginacao = false;
    public $pagina = 1;
    public $totalPagina = 8;
    // public $limit = false;
    // public $limitAux = false;


    /*Relacionamentos (inverso) (1 para muitos) */
    public function user()
    {
        return $this->belongsTo(User::class);
        // Uso: $p->find(1)->user
        // Retorno: O usuário que este produto pertence (id=1) coluna "id" da tabela "users"
    }
    /*Relacionamentos (1 para muitos) */
    public function favorito()
    {
        return $this->hasMany(Favorito::class);
        // Uso: $u->find(1)->favorito
        // Retorno: Todos os favoritos com "1" na coluna "produto_id" da tabela "favoritos"
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
        // Uso: $p->find(1)->user
        // Retorno: O usuário que este produto pertence (id=1) coluna "id" da tabela "users"
    }

    /**
     * [getProdutos description]
     * @param  boolean $limit [description]
     * @return [type]         [description]
     */
    public function getProdutos()
    {
        if($this->paginacao){
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if($limit['fim']){
                $produtos = $this->where('status',1)
                ->join('categorias as c','produtos.categoria_id','c.id')
                ->select('produtos.*','c.categoria')
                ->limit($limit['inicio'])
                ->offset($limit['fim'])
                ->orderBy('produtos.id', 'DESC')
                ->get();
            }else{
                $produtos = $this->where('status',1)
                ->join('categorias as c','produtos.categoria_id','c.id')
                ->select('produtos.*','c.categoria')
                ->limit($limit['inicio'])
                ->orderBy('produtos.id', 'DESC')
                ->get();
            }
        }else{
            $produtos = $this->where('status',1)
            ->join('categorias as c','produtos.categoria_id','c.id')
            ->select('produtos.*','c.categoria')
            ->orderBy('produtos.id', 'DESC')
            ->get();
        }

        $retorno = [
            'itens' => $produtos,
            'total' => $this->count()
        ];

        return $retorno;
    }

    /**
     * [getMeusProdutos description]
     * @param  boolean $limit [description]
     * @return [type]         [description]
     */
    public function getMeusProdutos($limit=false)
    {
        if($limit){
            if($this->limitAux){
                $meusProdutos =  $this->withTrashed()
                ->where('user_id',Auth::user()->id)
                ->limit($this->limit)
                ->offset($this->limitAux)
                ->orderBy('status', 'DESC')
                ->orderBy('deleted_at', 'ASC')
                ->get();
            }else{
                $meusProdutos =  $this->withTrashed()
                ->where('user_id',Auth::user()->id)
                ->limit($this->limit)
                ->orderBy('status', 'DESC')
                ->orderBy('deleted_at', 'ASC')
                ->get();
            }
        }else{
            $meusProdutos =  $this->withTrashed()
            ->where('user_id',Auth::user()->id)
            ->orderBy('status', 'DESC')
            ->orderBy('deleted_at', 'ASC')
            ->get();
        }

        return $meusProdutos;
    }

    /**
     * Traz dados de um produto
     * @param  [type] $produto_id [description]
     * @return [type]             [description]
     */
    public function getDescricaoProduto($produto_id)
    {
        $produto_id = (int) $produto_id;
        $dadosProduto = $this->where('produtos.id',$produto_id)
        ->join('categorias as c','produtos.categoria_id','c.id')
        ->join('users as u', 'produtos.user_id', 'u.id')
        ->select(
            'produtos.*',
            'u.*',
            'c.categoria'
        )
        ->get();

        return $dadosProduto[0];
    }

    /**
     * [getProdutos description]
     * @param  boolean $limit [description]
     * @return [type]         [description]
     */
    // public function getProdutos($limit=false)
    // {
    //     if($limit){
    //         if($this->limitAux){
    //             $produtos = $this->where('status',1)
    //             ->join('categorias as c','produtos.categoria_id','c.id')
    //             ->select('produtos.*','c.categoria')
    //             ->limit($this->limit)
    //             ->offset($this->limitAux)
    //             ->orderBy('produtos.id', 'DESC')
    //             ->get();
    //         }else{
    //             $produtos = $this->where('status',1)
    //             ->join('categorias as c','produtos.categoria_id','c.id')
    //             ->select('produtos.*','c.categoria')
    //             ->limit($this->limit)
    //             ->orderBy('produtos.id', 'DESC')
    //             ->get();
    //         }
    //     }else{
    //         $produtos = $this->where('status',1)
    //         ->join('categorias as c','produtos.categoria_id','c.id')
    //         ->select('produtos.*','c.categoria')
    //         ->orderBy('produtos.id', 'DESC')
    //         ->get();
    //     }
    //
    //     // $categorias = Categoria::all();
    //     // foreach ($produtos as $produto) {
    //     //     $categoria = $categorias->find($produto->categoria_id)->categoria;
    //     //     $produto->categoria_nome = $categoria;
    //     // }
    //
    //     return $produtos;
    // }

}
