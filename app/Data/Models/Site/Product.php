<?php

namespace App\Data\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Data\Models\User;
use App\Data\Models\Site\Favorite;
use App\Data\Models\Categoria;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'produtos';
    protected $fillable = ['user_id', 'categoria_id', 'titulo', 'slug', 'descricao', 'valor', 'estado', 'nm_imagem'];
    protected $dates = ['deleted_at'];

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
        return $this->hasMany(Favorite::class);
        // Uso: $u->find(1)->favorito
        // Retorno: Todos os favoritos com "1" na coluna "produto_id" da tabela "favoritos"
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
        // Uso: $p->find(1)->user
        // Retorno: O usuário que este produto pertence (id=1) coluna "id" da tabela "users"
    }
}
