<?php

namespace App\Models\MinhaConta;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\Produto;
use App\Models\User;


class Favorito extends Model
{
    protected $table = 'favoritos';

    public function produto()
    {
        return $this->belongsTo(Produto::class);
        // Uso: $f->find(1)->produto
        // Retorno: O produto que este favorito pertence (id=1) coluna "id" da tabela "produto"
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // Uso: $f->find(1)->user
        // Retorno: O user que este favorito pertence (id=1) coluna "id" da tabela "user"
    }

    public function getFavoritos()
    {
        $user_id = Auth::user()->id;
        $favoritos = User::find($user_id)->favorito->where('status',1);

        return $favoritos;
    }

}
