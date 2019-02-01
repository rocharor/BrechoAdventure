<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Contact extends Model
{
    use SoftDeletes;

    protected $table = 'contatos';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nome', 'email','tipo','mensagem','status_resposta'
    ];

    public function setMensagem($data)
    {
        $this->nome = $data['name'];
        $this->email = $data['email'];
        $this->tipo = $data['category'];
        $this->mensagem = $data['message'];

        if ($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public function getContato($id)
    {
        $contato_id = (int) $id;
        $dadosContato = $this->find($contato_id);

        return $dadosContato;
    }


    public function setRespostaMensagem($param)
    {
        DB::table('contato_respostas')->insert([
            'contato_id' => $param['contato_id'],
            'user_id' => $param['user_id'],
            'mensagem' => $param['mensagem']
        ]);

        $contato = $this->find($param['contato_id']);
        $contato->status_resposta = 1;
        $retorno = $contato->save();

        if ($retorno){
            return true;
        }else{
            return false;
        }
    }


    public function getPendentes()
    {
        $pendentes = $this->where('status_resposta',0)->get();

        return $pendentes;
    }

    public function getQuantidades()
    {
        $data['respondidos'] = $this->where('status_resposta',1)->count();
        $data['pendentes'] = $this->where('status_resposta',0)->count();

        return $data;
    }
}
