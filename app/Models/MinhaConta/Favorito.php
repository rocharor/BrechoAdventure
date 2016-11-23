<?php

namespace App\Models\MinhaConta;

use Illuminate\Database\Eloquent\Model;
use App\Models\Site\Produto;

class Favorito extends Model
{
    protected $table = 'favoritos';

    /*Relacionamentos (inverso) (1 para muitos) */
    public function relFavoritoProduto()
    {
        return $this->belongsTo(Produto::class,'produto_id');
    }

    public function getFavoritos($user_id)
    {
        $arrFavoritos = Favorito::where('user_id','=',$user_id)->where('status','=',1)->get();
        // $sql = "SELECT produto_id FROM favoritos WHERE usuario_id = {$user_id} AND status = 1";
        //
        // $arrFavoritos = [];
        // $rs = $this->conn->query($sql);
        // while ($row = $rs->fetch(\PDO::FETCH_ASSOC)) {
        //     $arrFavoritos[] = $row['produto_id'];
        // }
        return $arrFavoritos;
    }

}
