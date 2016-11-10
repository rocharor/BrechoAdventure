<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Site\Produto;

class Usuario extends Model
{

    /*Relacionamentos*/
    public function relProduto()
    {
        return $this->hasMany(Produto::class);
    }
}
