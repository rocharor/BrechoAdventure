<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use App\Models\Site\Mensagem;

class Conversa extends Model
{
    public function mensagem()
    {
        return $this->hasMany(Mensagem::class);
        // Uso: $conversa->find(1)->mensagem
        // Retorno: Todas as mensagens com "1" na coluna "conversa_id" da tabela "mensagens"
    }
}
