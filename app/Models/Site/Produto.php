<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Site\Favorito;
// use DB;

class Produto extends Model
{
    protected $table = 'produtos';

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

    public function getProdutos($limit=false, $limitAux=false)
    {

        if(Auth::user()){

        }
        if($limit){
            if($limitAux){
                $produtos = $this->limit($limit)->offset($limitAux)->get();
            }else{
                $produtos = $this->limit($limit)->get();
            }
        }else{
            $produtos = $this->all();
        }

        return $produtos;
    }

    /**
     * Traz dados de um produto
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
