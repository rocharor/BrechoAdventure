<?php

    namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Site\Produto;

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

    /*Relacionamentos (1 para muitos) */
    public function produto()
    {
        //associa com o campo user_id da tabela Produtos
        return $this->hasMany(Produto::class);
    }
}
