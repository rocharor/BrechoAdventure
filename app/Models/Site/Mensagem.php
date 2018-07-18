<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Site\Conversa;
use App\Models\Site\Mensagem;
use App\Models\Site\Produto;
use App\Models\User;
use App\Services\Util;

class Mensagem extends Model
{
    use Util, SoftDeletes;

    public $table = 'mensagens';
    protected $dates = ['deleted_at'];

    public function conversa()
    {
        return $this->belongsTo(Conversa::class);
        // Uso: $mensagem->find(1)->conversa
        // Retorno: O conversa que esta mensagem pertence (id=1) coluna "id" da tabela "conversa"
    }
    // dd($conversas_meus_produtos);

    public function buscaConversasEnviadas()
    {
        $conversas_envio = Conversa::where('user_id_envio',Auth::user()->id)->get();
        $conversas = $this->buscaMensagens($conversas_envio);
        return $conversas;
    }

    public function buscaConversasRecebidas()
    {
        $conversas_meus_produtos = Conversa::where('user_id_destino',Auth::user()->id)->get();
        $conversas = $this->buscaMensagens($conversas_meus_produtos);

        return $conversas;
    }

    public function buscaMensagens ($objConversa)
    {
        $conversas = [];
        $qtdNotificacaoGeral = 0;
        foreach ($objConversa as  $key1=>$conversa) {
            $qtdNotificacaoProduto = 0;
            $produto = Produto::find($conversa->produto_id);
            $arrImg = explode('|',$produto->nm_imagem);
            $produto->imgPrincipal = $arrImg[0];
            $mensagens = Conversa::find($conversa->id)->mensagem;
            foreach ($mensagens as $key=>$mensagem) {
                if($mensagem->user_id_envio == Auth::user()->id){
                    $mensagens[$key]['posicao'] = 'esquerda';
                    $mensagens[$key]['nome'] = Auth::user()->name;
                }else{
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
