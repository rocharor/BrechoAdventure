<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Site\Produto;
use App\Models\Site\Favorito;
use App\Models\Acl\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','dt_nascimento','endereco','numero','complemento','bairro','cidade','uf','cep','telefone_fixo','telefone_cel','nome_imagem','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relation Produto
     * @return object
     */
    public function produto()
    {
        return $this->hasMany(Produto::class);
        // Uso: $u->find(1)->produto
        // Retorno: Todos os produtos com "1" na coluna "user_id" da tabela "produtos"
    }

    /**
     * Relation Favorito
     * @return object
     */
    public function favorito()
    {
        return $this->hasMany(Favorito::class);
        // Uso: $u->find(1)->favorito
        // Retorno: Todos os favoritos com "1" na coluna "user_id" da tabela "favorito"
    }

    /**
     * Relation Roles
     * @return object
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Validate permission the user
     * @param  Object/String  $role = Object of Roles or string of one role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name',$role);
        }

        return !! $role->intersect($this->roles)->count();
    }
}
