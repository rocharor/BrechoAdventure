<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    public function getProdutos($limit = false, $categorias = false)
    {
        $produtos = Produtos::limit($limit)->get();
        //$produtos = Produtos::all()->limit(2);
        //$produtos = Produtos::where('status', '=', 0)->orwhere('status', '=', 1)->get();

        dd($produtos);

        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }

        $produtos = array();

        $rs = $this->conn->query($sql);
        while ($row = $rs->fetch(\PDO::FETCH_ASSOC)) {
            $produtos[] = $row;
        }

        return $produtos;
    }
}
