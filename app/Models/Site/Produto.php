<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Usuario;

class Produto extends Model
{
    protected $table = 'produtos';

    /*Relacionamentos*/
    public function relUsuario()
    {
        return $this->belongsTo(Usuario::class,'usuario_id');
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
                    ->join('usuarios as u','p.usuario_id','=','u.id')
                    ->select('p.categoria_id','p.titulo','p.descricao','p.valor','p.estado','p.nm_imagem','u.nome','u.email','u.telefone_fixo as fixo','u.telefone_cel as cel')
                    ->where('p.id','=',$produto_id)
                    ->get();

        // $sql = "SELECT p.categoria_id,p.titulo,p.descricao,p.valor,p.estado,p.nm_imagem,u.nome,u.email,u.telefone_fixo as fixo,u.telefone_cel as cel
        //         FROM produtos p
        //         inner join usuarios u
        //         on (u.id = p.usuario_id)
        //         WHERE p.id = {$produto_id}";
        //
        // $arrProduto = $this->conn->query($sql)->fetch(\PDO::FETCH_ASSOC);

        return $arrProduto;
    }
}
