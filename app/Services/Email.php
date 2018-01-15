<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class Email extends Controller
{
    private $host = "smtp.gmail.com";
    private $emailAdmin = 'rocharor@gmail.com';
    private $debug = 0;
    private $mail;

    /**
     * Ajustes das informaçoes
     */
    public function __construct()
    {
        $this->mail = new \PHPMailer();
        $this->mail->CharSet = "utf-8";
        $this->mail->WordWrap = 50;
        $this->mail->IsHTML(true);
        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = $this->debug;
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Host = $this->host;
        $this->mail->Port = 587;
        $this->mail->Username = 'brechoAdventure@gmail.com';
        $this->mail->Password = 'rghdirkeakjfzvdh';
        $this->mail->SetFrom('brechoAdventure@gmail.com', 'Brechó Adventure');
        $this->mail->AddReplyTo("noreplay@brechoAdventure.com", "Brechó Adventure");
    }

    /**
     *
     * @param unknown $email
     * @param unknown $assunto
     * @param unknown $corpo
     * @param unknown $copias
     * @return boolean
     */
    public function sendEmail($email, $assunto, $corpo, $copias=[])
    {
        echo $email;
        $mail = $this->mail;
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        // $mail->MsgHTML($corpo);
        $mail->AddAddress($email);
        $this->mail->AddBCC = 'brechoadventure@gmail.com'; //copia oculta
        foreach($copias as $copia){
            $this->mail->AddCC = $copia; // copia simples
        }

        if ($mail->Send()){
            $mail->ClearAllRecipients();
            return true;
        }else{
            return false;
        }
    }
    /**
     * Envia uma resposta automática quando alguem envia umamensagam pelo contato do site
     * @param unknown $nome
     * @param unknown $email
     * @return boolean
     */
    public function respAutomaticaContato($nome, $email)
    {
        global $smarty;

        $assunto = "Resposta automatica";
        $corpo = view('email/respAutomatica',['nome'=>$nome,'email'=>$email]);

        if ($this->sendEmail($email,$assunto,$corpo)){
            $this->avisoNovaMensagem();
            return true;
        }else{
            return false;
        }
    }

    /**
     *
     * @return boolean
     */
    public function avisoNovaMensagem()
    {
        $assunto = "Nova Mensagem";
        $corpo = view('email/admin');
        $retorno = $this->sendEmail($this->emailAdmin, $assunto, $corpo);

        return $retorno;
    }








    /**
     * Envia o e-mail para usuários que os produtos foram aprovados
     * @param unknown $email
     * @return boolean
     */
    public function produtoAprovado($email)
    {
        global $smarty;

        $assunto = 'Parabéns seu produto foi aprovado.';
        $corpo = $smarty->fetch("email/produtoAprovado.html");
        $retorno = $this->sendEmail($email, $assunto, $corpo);

        return $retorno;
    }




    /**
     * Informa o Admin que existem produtos pendentes
     */
    public function avisoNovoProduto()
    {
        $assunto = "Novo Produto";
        $corpo = "Um novo produto acaba de ser cadastrado e encontra-se pendente.";
        $retorno = $this->sendEmail($this->emailAdmin, $assunto, $corpo);

        return $retorno;
    }











    /**
     * Método para recuperar senha
     *
     * @param mixed $dados_user
     */
    public function recuperarSenha($dados_user)
    {
        global $smarty;

        $mail = $this->mail;
        $smarty->assign("nome", $dados_user['nome']);
        $smarty->assign("email", $dados_user['email']);
        $smarty->assign("senha_ext", $dados_user['senha_ext']);
        $smarty->assign("data_cadastro", $dados_user['data_cadastro']);

        $mail->Subject = "Recuperação de senha";

        $html = $smarty->fetch("email/recuperarSenha.html");
        $mail->MsgHTML($html);

        $mail->AddAddress($dados_user['email']);

        if ($mail->Send())
            return true;
            else
                return false;
    }
}
