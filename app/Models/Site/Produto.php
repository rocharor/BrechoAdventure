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
        $produtos = [];
        $total = [];
        if($this->paginacao){
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if($limit['fim']){
                $produtos = $this->where('status',1)
                ->limit($limit['inicio'])
                ->offset($limit['fim'])
                ->orderBy('produtos.id', 'DESC')
                ->get();
            }else{
                $produtos = $this->where('status',1)
                ->limit($limit['inicio'])
                ->orderBy('produtos.id', 'DESC')
                ->get();
            }
            $total = $this->where('status',1)->count();
        }else{
            $produtos = $this->where('status',1)
            ->get();
        }


        $retorno = [
            'itens' => $produtos,
            'total' => $total
        ];

        return $retorno;
    }

    /**
     * Traz dados de um produto
     * @param  [type] $param [pode ser um int ou string]
     * @return [type]             [Dados do produto]
     */
    public function getProduto($param)
    {
        $dadosProduto = [];
        if (is_string($param)) {
            $slug = trim($param);
            $dadosProduto = $this->where('slug', $slug)->first();
        }else{
            $produto_id = (int) $param;
            $dadosProduto = $this->find($produto_id);
        }

        return $dadosProduto;
    }

    /**
     * [getMeusProdutos description]
     * @param  boolean $limit [description]
     * @return [type]         [description]
     */
    public function getMeusProdutos()
    {
        $meusProdutos = [];
        $total = [];
        if($this->paginacao){
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if($limit['fim']){
                $meusProdutos =  $this->withTrashed()
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->offset($limit['fim'])
                ->orderBy('status', 'DESC')
                ->orderBy('deleted_at', 'ASC')
                ->get();
            }else{
                $meusProdutos =  $this->withTrashed()
                ->where('user_id',Auth::user()->id)
                ->limit($limit['inicio'])
                ->orderBy('status', 'DESC')
                ->orderBy('deleted_at', 'ASC')
                ->get();
            }
            $total = $this->where('status',1)->where('user_id',Auth::user()->id)->count();
        }else{
            $meusProdutos =  $this->withTrashed()
            ->where('user_id',Auth::user()->id)
            ->orderBy('status', 'DESC')
            ->orderBy('deleted_at', 'ASC')
            ->get();
        }

        $retorno = [
            'itens' => $meusProdutos,
            'total' => $total
        ];

        return $retorno;
    }

    public function mountFilter()
    {
        $this->paginacao = false;
        $products = $this->getProdutos();

        foreach ($products['itens'] as $key=>$product) {
            if (!isset($data['Categoria']['itens'][$product->categoria->categoria])) {
                $data['Categoria']['itens'][$product->categoria->categoria] = [
                    'id'=>$product->categoria_id,
                    'rotulo'=>$product->categoria->categoria,
                    'qtd' => 1
                ];
            }else{
                $data['Categoria']['itens'][$product->categoria->categoria]['qtd'] += 1;
            }

            if (!isset($data['Estado']['itens'][$product->estado])) {
                $data['Estado']['itens'][$product->estado] = [
                    'id'=>$product->estado,
                    'rotulo'=>$product->estado,
                    'qtd' => 1
                ];
            }else{
                $data['Estado']['itens'][$product->estado]['qtd'] += 1;
            }
        }

        return $data;
    }

    /*******
    / ADMIN
    /*******/
    public function getPendentes()
    {
        $pendentes = $this->where('status',2)->orderBy('updated_at', 'DESC')->get();

        return $pendentes;
    }

    public function getQuantidades()
    {
        $data['ativos'] = $this->where('status',1)->count();
        $data['pendentes'] = $this->where('status',2)->count();
        $data['excluidos'] = $this->onlyTrashed()->count();

        return $data;
    }

    public function updateAdmin($id, $param)
    {
        $produto = $this->find($id);
        foreach ($param as $key=>$value) {
            if ($key == '_token' || $key == 'id') {
                continue;
            }
            $produto->$key = $value;
        }

        if ($produto->save()) {
            return true;
        }

        return false;
    }
}
