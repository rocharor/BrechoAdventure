<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BrechoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo, $param)
    {
        $this->mail_admin = 'rocharor@gmail.com';
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
                return $this->replyAutomatic();
                break;
            case 2:
                return $this->newMensage();
                break;
            case 3:
                return $this->replyContact();
                break;
        }
    }

    public function replyAutomatic()
    {
        return $this
        ->subject('Resposta automática')
        ->view('email.respAutomatica')
        ->with([
            'name'=>$this->param['name'],
            'type'=>$this->param['category'],
            'mensage'=>$this->param['message']
        ]);
    }

    public function newMensage()
    {
        return $this
        ->to($this->mail_admin)
        ->subject('Nova Mensagem Site')
        ->view('email.adminMensagem');
    }

    public function replyContact()
    {
        return $this
        ->to($this->param['email'])
        ->subject($this->param['assunto'])
        ->view('email.respContato')
        ->with([
            'name' => $this->param['nome'],
            'mensage' => $this->param['mensagem'],
            'reply' => $this->param['resposta']

        ]);
    }

    // /**
    //  * Envia o e-mail para usuários que os produtos foram aprovados
    //  * @param unknown $email
    //  * @return boolean
    //  */
    // public function produtoAprovado()
    // {
    //     return $this
    //     ->subject('Parabéns seu produto foi aprovado')
    //     ->view('email.produtoAprovado')
    //     ->with([
    //         'name'=>$this->param->name,
    //         'title'=>$this->param->titulo
    //     ]);
    // }
    //
    // /**
    //  * Informa o Admin que existem produtos pendentes
    //  */
    // public function avisoNovoProduto()
    // {
    //     return $this
    //     ->subject('Novo Produto Site')
    //     ->to('rocharor@gmail.com')
    //     ->view('email.adminProduto',$data);
    // }
    //
}
