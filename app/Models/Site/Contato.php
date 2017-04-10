<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use SoftDeletes;

    protected $table = 'contatos';
    protected $dates = ['deleted_at'];

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
