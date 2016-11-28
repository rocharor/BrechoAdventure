@extends('template')
@section('content')
    <h1 class="text-danger">MEUS PRODUTOS</h1>
    <div class="row">
        {if $meusProdutos|@count eq 0}
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        {else}
            {counter assign=i start=0 print=false}
            {foreach from=$meusProdutos item=produto}
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="border: solid 0px;">
                    <div style="width: 300px; height: 20px;">
                        {if $produto.status eq 0}
                            <span class="label label-danger">Produto exclu&iacute;do</span>
                        {else}
                            Data de cadastro: <b>{$produto.data_cadastro}</b>
                        {/if}
                    </div>
                    <div style="width: 300px; height: 280px; position: relative;">
                        {if $produto.img_principal eq ''}
                            <img src="/imagens/produtos/padrao.gif" style="width: 90%; height: 90%;">
                        {else}
                            <img src="/imagens/produtos/{$produto.img_principal}" style="width: 90%; height: 90%;">
                        {/if}
                    </div>
                    {if $produto.status eq 1}
                    <div>
                        <a href="/minha-conta/meus-produtos/meusProdutosEditar/produto/{$produto.id}" class="btn btn-success" data-produto-id="{$produto.id}">Editar</a>
                        <button class="btn btn-danger act-excluir-produto" data-produto-id="{$produto.id}">Excluir</button>
                    </div>
                    {/if}
                </div>
                {counter}
                {if $i is  div by 3}
                     &nbsp;<hr>
                {/if}
            {/foreach}
        {/if}
    </div>

    <script type="text/javascript" src="/libs/jquery/jquery.maskMoney.min.js"></script>
    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
