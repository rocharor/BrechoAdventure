<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = 'contatos';

    public function setMensagem($dados)
    {
        $nome = trim($dados['nome']);
        $email = trim($dados['email']);
        $tipo = trim($dados['tipo']);
        $mensagem = trim($dados['mensagem']);

        $objContato = new Contato;
        $objContato->nome = $nome;
        $objContato->email = $email;
        $objContato->tipo = $tipo;
        $objContato->mensagem = $mensagem;
        $objContato->status_resposta = 0;

        if ($objContato->save()){
            return true;
        }else{
            return false;
        }

        //$sql = "INSERT INTO mensagens (nome,email,tipo,mensagem,data_mensagem) VALUES (:nome,:email,:tipo,:mensagem,NOW())";

        // $param = [
        //     ':nome' => $nome,
        //     ':email' => $email,
        //     ':tipo' => $tipo,
        //     ':mensagem' => $mensagem
        // ];
        //
        // $rs = $this->conn->prepare($sql);
        // if ($rs->execute($param)) {
        //     return true;
        // } else {
        //     return false;
        // }

    }

}
