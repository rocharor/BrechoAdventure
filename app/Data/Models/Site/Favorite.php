<?php

namespace App\Data\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Data\Models\Site\Product;
use App\Data\Models\User;


class Favorite extends Model
{
    use SoftDeletes;

    protected $table = 'favoritos';
    protected $dates = ['deleted_at'];

    public function produto()
    {
        return $this->belongsTo(Product::class);
        // Uso: $f->find(1)->produto
        // Retorno: O produto que este favorito pertence (id=1) coluna "id" da tabela "produto"
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        // Uso: $f->find(1)->user
        // Retorno: O user que este favorito pertence (id=1) coluna "id" da tabela "user"
    }
}
