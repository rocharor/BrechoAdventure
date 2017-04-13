<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BrechoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tipo;
    public $param;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo, $param)
    {
        $this->tipo = $tipo;
        $this->param = $param;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        switch ($this->tipo) {
            case 1:
                return $this->respAutomaticaContato();
                break;
            case 2:
                # code...
                break;
            case 3:
                # code...
                break;
        }
    }

    public function respAutomaticaContato()
    {
        $data = [
            'nome'=>$this->param->name
        ];

        return $this
        ->subject('Resposta automática')
        ->view('email.respAutomatica',$data);

        // $this->avisoNovaMensagem();
        // return $return;
    }

    /**
     * Envia o e-mail para usuários que os produtos foram aprovados
     * @param unknown $email
     * @return boolean
     */
    public function produtoAprovado($email)
    {
        return $this
        ->subject('Parabéns seu produto foi aprovado')
        ->view('email.produtoAprovado',$data);
    }

    /**
     * Informa o Admin que existem produtos pendentes
     */
    public function avisoNovoProduto()
    {
        return $this
        ->subject('Novo Produto Site')
        ->view('email.adminProduto',$data);
    }

    public function avisoNovaMensagem()
    {
        return $this
        ->subject('Nova Mensagem Site')
        ->view('email.adminMensagem');
    }
}
