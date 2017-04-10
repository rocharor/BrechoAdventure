<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Site\Produto;
use App\Models\User;


class Favorito extends Model
{
    use SoftDeletes;

    protected $table = 'favoritos';
    protected $dates = ['deleted_at'];

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
        $favoritos = [];
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $favoritos = User::find($user_id)->favorito->where('status',1);
        }

        return $favoritos;
    }

}
