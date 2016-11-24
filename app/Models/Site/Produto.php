<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MinhaConta\Favorito;
// use DB;

class Produto extends Model
{
    protected $table = 'produtos';

    /*Relacionamentos (inverso) (1 para muitos) */
    public function user()
    {
        //associa com o campo id da tabela Usuarios
        return $this->belongsTo(User::class);
    }
    /*Relacionamentos (1 para muitos) */
    public function favorito()
    {
        return $this->hasMany(Favorito::class);
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

        $dadosProduto = Produto::find($produto_id);
        $dadosUser = $dadosProduto->relUser;
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
