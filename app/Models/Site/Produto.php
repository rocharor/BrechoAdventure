<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\User;

class Produto extends Model
{
    protected $table = 'produtos';

    /*Relacionamentos (1 para 1) */
    public function relUsuario()
    {
        //associa com o campo id da tabela Usuarios
        return $this->belongsTo(User::class);
    }

    public function getProdutos($limit = false, $categorias = false)
    {
        $produtos = Produto::limit($limit)->get();
        //$produtos = Produtos::all()->limit(2);
        //$produtos = Produtos::where('status', '=', 0)->orwhere('status', '=', 1)->get();

        return $produtos;
    }

    /**
     * Traz dados de um produto
     */
    public function getDescricaoProduto($produto_id)
    {
        $produto_id = (int) $produto_id;

        $arrProduto = DB::table('produtos as p')
                    ->join('users as u','p.usuario_id','=','u.id')
                    ->select('p.categoria_id','p.titulo','p.descricao','p.valor','p.estado','p.nm_imagem','u.name','u.email','u.telefone_fixo as fixo','u.telefone_cel as cel')
                    ->where('p.id','=',$produto_id)
                    ->get();

        return $arrProduto[0];
    }
}
