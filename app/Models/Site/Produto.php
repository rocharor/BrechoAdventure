<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Site\Favorito;
use App\Models\Categoria;

class Produto extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';
    protected $dates = ['deleted_at'];
    public $limit = false;
    public $limitAux = false;


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
    public function getProdutos($limit=false)
    {
        if($limit){
            if($this->limitAux){
                $produtos = $this->where('status',1)
                ->join('categorias as c','produtos.categoria_id','c.id')
                ->select('produtos.*','c.categoria')
                ->limit($this->limit)
                ->offset($this->limitAux)
                ->orderBy('produtos.id', 'DESC')
                ->get();
            }else{
                $produtos = $this->where('status',1)
                ->join('categorias as c','produtos.categoria_id','c.id')
                ->select('produtos.*','c.categoria')
                ->limit($this->limit)
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

        // $categorias = Categoria::all();
        // foreach ($produtos as $produto) {
        //     $categoria = $categorias->find($produto->categoria_id)->categoria;
        //     $produto->categoria_nome = $categoria;
        // }

        return $produtos;
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
        $dadosProduto = Produto::find($produto_id);
        $dadosUser = $dadosProduto->user;

        $arrProduto = '';
        if($dadosUser != '' && $dadosProduto != ''){
            $arrProduto = [
                'titulo'=>$dadosProduto->titulo,
                'categoria_id'=>$dadosProduto->categoria_id,
                'descricao'=>$dadosProduto->descricao,
                'valor'=>$dadosProduto->valor,
                'estado'=>$dadosProduto->estado,
                'nm_imagem'=>$dadosProduto->nm_imagem,
                'name'=>$dadosUser->name,
                'email'=>$dadosUser->email,
                'fixo'=>$dadosUser->telefone_fixo,
                'cel'=>$dadosUser->telefone_cel
            ];
        }

        // $arrProduto = DB::table('produtos as p')
        //             ->join('users as u','p.user_id','=','u.id')
        //             ->select('p.categoria_id','p.titulo','p.descricao','p.valor','p.estado','p.nm_imagem','u.name','u.email','u.telefone_fixo as fixo','u.telefone_cel as cel')
        //             ->where('p.id','=',$produto_id)
        //             ->get();

        return $arrProduto;
    }
}
