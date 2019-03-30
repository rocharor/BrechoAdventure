<?php

namespace App\Data\Repositories\Site;

use DB;
use App\Services\Util;
use App\Data\Models\Site\Contact;

class ContactRepository
{
    use Util;

    private $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        $this->model->nome = $data['name'];
        $this->model->email = $data['email'];
        $this->model->tipo = $this->getTipoContato($data['category']);
        $this->model->mensagem = $data['message'];

        if ($this->model->save()) {
            return 1;
        }

        return 0;
    }

    public function getContato($id)
    {
        $contato_id = (int)$id;
        $dadosContato = $this->model->find($contato_id);

        return $dadosContato;
    }


    public function setRespostaMensagem($param)
    {
        DB::table('contato_respostas')->insert([
            'contato_id' => $param['contato_id'],
            'user_id' => $param['user_id'],
            'mensagem' => $param['mensagem']
        ]);

        $contato = $this->model->find($param['contato_id']);
        $contato->status_resposta = 1;
        $retorno = $contato->save();

        if ($retorno) {
            return true;
        } else {
            return false;
        }
    }


    public function getPendentes()
    {
        $pendentes = $this->model->where('status_resposta', 0)->get();

        return $pendentes;
    }

    public function getQuantidades()
    {
        $data['respondidos'] = $this->model->where('status_resposta', 1)->count();
        $data['pendentes'] = $this->model->where('status_resposta', 0)->count();

        return $data;
    }
}
