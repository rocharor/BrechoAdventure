<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'contatos';

    protected $fillable = [
        'nome', 'email','tipo','mensagem','status_resposta'
    ];
    public function setMensagem($dados)
    {
        unset($dados['_token']);

        if (Contato::create($dados)){
            return true;
        }else{
            return false;
        }
    }
}
