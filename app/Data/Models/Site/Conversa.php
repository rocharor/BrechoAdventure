<?php

namespace App\Data\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Data\Models\Site\Message;

class Conversa extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function mensagem()
    {
        return $this->hasMany(Message::class);
        // Uso: $conversa->find(1)->mensagem
        // Retorno: Todas as mensagens com "1" na coluna "conversa_id" da tabela "mensagens"
    }
}
