<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','apelido','dt_nascimento','endereco','numero','complemento','bairro','cidade','uf','cep','telefone_fixo','telefone_cel','nome_imagem','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*Relacionamentos*/
    public function relProduto()
    {
        return $this->hasMany(Produto::class);
    }
}
