<?php

namespace App\Data\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Site\Conversa;

class Message extends Model
{
    use SoftDeletes;

    public $table = 'mensagens';

    protected $dates = ['deleted_at'];

    public function conversa()
    {
        return $this->belongsTo(Conversa::class);
        // Uso: $mensagem->find(1)->conversa
        // Retorno: O conversa que esta mensagem pertence (id=1) coluna "id" da tabela "conversa"
    }
}
