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
    protected $fillable = ['user_id', 'categoria_id', 'titulo', 'slug', 'descricao', 'valor', 'estado', 'nm_imagem'];
    protected $dates = ['deleted_at'];
    public $paginacao = false;
    public $pagina = 1;
    public $totalPagina = 8;//12;
    public $parametros = [];

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
        } else {
            $produto_id = (int)$param;
            $dadosProduto = $this->find($produto_id);
        }

        return $dadosProduto;
    }

    public function getProdutos()
    {
        $objProdutos = [];
        $total = [];
        if ($this->paginacao) {
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);
            if ($limit['fim']) {
                $objProdutos = $this
                    ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                    ->select('produtos.*', 'categorias.slug as categoria_slug')
                    ->where('status', 1)
                    ->limit($limit['inicio'])
                    ->offset($limit['fim'])
                    ->orderBy('produtos.id', 'DESC');
            } else {
                $objProdutos = $this
                    ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                    ->select('produtos.*', 'categorias.slug as categoria_slug')
                    ->where('status', 1)
                    ->limit($limit['inicio'])
                    ->orderBy('produtos.id', 'DESC');
            }
            $total = $this->where('status', 1)->count();
        } else {
            $objProdutos = $this
                ->join('categorias', 'categorias.id', 'produtos.categoria_id')
                ->select('produtos.*', 'categorias.slug as categoria_slug')
                ->where('status', 1);
        }

        // Para montar o filtro lateral
        if (count($this->parametros) > 0) {

            if (isset($this->parametros['categoria'])) {
                $objProdutos = $objProdutos
                    ->whereIn('categorias.slug', $this->parametros['categoria']);
            }

            if (isset($this->parametros['estado'])) {
                $objProdutos = $objProdutos
                    ->whereIn('produtos.estado', $this->parametros['estado']);
            }
            $produtos = $objProdutos->get();

            $total = count($produtos);
        } else {
            $produtos = $objProdutos->get();
        }

        $retorno = [
            'itens' => $produtos,
            'total' => $total
        ];

        return $retorno;
    }

    public function getMeusProdutos()
    {
        $meusProdutos = [];
        $total = [];
        if ($this->paginacao) {
            $limit = $this->geraLimitPaginacao($this->pagina, $this->totalPagina);

            if ($limit['fim']) {
                $meusProdutos = $this->where('user_id', Auth::user()->id)
                    ->limit($limit['inicio'])
                    ->offset($limit['fim'])
                    ->orderBy('status', 'DESC')
                    ->orderBy('updated_at', 'DESC')
                    ->orderBy('deleted_at', 'ASC')
                    ->get();
            } else {
                $meusProdutos = $this->where('user_id', Auth::user()->id)
                    ->limit($limit['inicio'])
                    ->orderBy('status', 'DESC')
                    ->orderBy('updated_at', 'DESC')
                    ->orderBy('deleted_at', 'ASC')
                    ->get();
            }
            $total = $this->where('status', 1)->where('user_id', Auth::user()->id)->count();
        } else {
            $meusProdutos = $this->where('user_id', Auth::user()->id)
                ->orderBy('status', 'DESC')
                ->orderBy('updated_at', 'DESC')
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
        $data = [];
        foreach ($products['itens'] as $key => $product) {
            if (!isset($data['Categoria']['itens'][str_slug($product->categoria->categoria)])) {
                $data['Categoria']['itens'][str_slug($product->categoria->categoria)] = [
                    'slug' => str_slug($product->categoria->categoria),
                    'rotulo' => $product->categoria->categoria,
                    'qtd' => 1,
                    'checked' => false
                ];
            } else {
                $data['Categoria']['itens'][str_slug($product->categoria->categoria)]['qtd'] += 1;
            }

            if (!isset($data['Estado']['itens'][str_slug($product->estado)])) {
                $data['Estado']['itens'][str_slug($product->estado)] = [
                    'slug' => str_slug($product->estado),
                    'rotulo' => $product->estado,
                    'qtd' => 1,
                    'checked' => false
                ];
            } else {
                $data['Estado']['itens'][str_slug($product->estado)]['qtd'] += 1;
            }
        }

        return $data;
    }

    /*******
    / ADMIN
    /*******/
    public function getPendentes()
    {
        $pendentes = $this->where('status', 2)->orderBy('updated_at', 'DESC')->get();

        return $pendentes;
    }

    public function getQuantidades()
    {
        $data['ativos'] = $this->where('status', 1)->count();
        $data['pendentes'] = $this->where('status', 2)->count();
        $data['excluidos'] = $this->onlyTrashed()->count();

        return $data;
    }
}
