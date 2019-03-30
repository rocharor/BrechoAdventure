<?php

namespace App\Data\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contatos';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome', 'email', 'tipo', 'mensagem', 'status_resposta'
    ];
}
