<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Site\Produto;
use App\Models\Site\Contato;
use App\Models\User;

class Dashboard extends Model
{
    private $modelProduto;
    private $modelContato;
    private $modelUser;

    public function __construct(Produto $produto, Contato $contato, User $user)
    {
        $this->modelProduto = $produto;
        $this->modelContato = $contato;
        $this->modelUser = $user;
    }

    public function dashboard()
    {
        $data['produtosPendentes'] = $this->modelProduto->getPendentes();
        $data['contatosPendentes'] = $this->modelContato->getPendentes();

        $data['produtosTotal'] = $this->modelProduto->getQuantidades();
        $data['contatosTotal'] = $this->modelContato->getQuantidades();
        $data['usuariosTotal'] = $this->modelUser->getQuantidades();
// dd($data);
        return $data;
    }
}
