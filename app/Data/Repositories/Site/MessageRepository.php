<?php

namespace App\Data\Repositories\Site;

use Illuminate\Support\Facades\Auth;
use App\Data\Models\Site\Message;
use App\Data\Models\Site\Conversa;
use App\Data\Models\Site\Product;
use App\Data\Models\User;
use App\Services\Util;

class MessageRepository
{
    use Util;

    private $model;
    private $conversaModel;
    private $productModel;

    public function __construct(Message $model, Conversa $conversaModel, Product $productModel)
    {
        $this->model = $model;
        $this->conversaModel = $conversaModel;
        $this->productModel = $productModel;
    }

    public function buscaConversasEnviadas()
    {
        $conversas_envio = $this->conversaModel->where('user_id_envio', Auth::user()->id)->get();
        $conversas = $this->buscaMensagens($conversas_envio);
        return $conversas;
    }

    public function buscaConversasRecebidas()
    {
        $conversas_meus_produtos = $this->conversaModel->where('user_id_destino', Auth::user()->id)->get();
        $conversas = $this->buscaMensagens($conversas_meus_produtos);

        return $conversas;
    }

    public function buscaMensagens($objConversa)
    {
        $conversas = [];
        $qtdNotificacaoGeral = 0;

        foreach ($objConversa as  $key1 => $conversa) {
            $qtdNotificacaoProduto = 0;
            $produto = $this->productModel->find($conversa->produto_id);
            $arrImg = explode('|', $produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $mensagens = $this->conversaModel->find($conversa->id)->mensagem;

            foreach ($mensagens as $key => $mensagem) {
                if ($mensagem->user_id_envio == Auth::user()->id) {
                    $mensagens[$key]['posicao'] = 'esquerda';
                    $mensagens[$key]['nome'] = Auth::user()->name;
                } else {
                    $mensagens[$key]['posicao'] = 'direita';
                    $mensagens[$key]['nome'] = User::find($mensagem->user_id_envio)->name;
                    if ($mensagem->lido == 0) {
                        $qtdNotificacaoGeral++;
                        $qtdNotificacaoProduto++;
                    }
                }
                $mensagem->data = $this->formataDataExibicao($mensagem->created_at);
            }
            $conversas[$key1]['produto'] = $produto;
            $conversas[$key1]['mensagens'] = $mensagens;
            $conversas[$key1]['naoLidas'] = $qtdNotificacaoProduto;
        }
        $conversas['naoLidas'] = $qtdNotificacaoGeral;

        return $conversas;
    }
}
