<?php

namespace App\Models\MinhaConta;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected $table = 'favoritos';

    public function getFavoritos($user_id)
    {
        $sql = "SELECT produto_id FROM favoritos WHERE usuario_id = {$user_id} AND status = 1";

        $arrFavoritos = [];
        $rs = $this->conn->query($sql);
        while ($row = $rs->fetch(\PDO::FETCH_ASSOC)) {
            $arrFavoritos[] = $row['produto_id'];
        }

        return $arrFavoritos;
    }

}
