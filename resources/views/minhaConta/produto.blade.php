@extends('template')
@section('content')

    <link type="text/css" rel="stylesheet" href="/css/produto.css" />

    <ol class="breadcrumb">
        <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
		<li class="active">Meus Produtos</li>
	</ol>

    <div class="row">
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-md-3 col-xs-12 div-meus-produtos" align="center">
                    @if ($produto->status == 0)
                        <span class="label label-danger">Produto exclu&iacute;do</span>
                    @elseif ($produto->status == 1)
                        <small>Data de cadastro: <b>{{ $produto->created_at }}</b></small>
                    @else
                        <span class="label label-warning"><b>Aguardando aprovação</b></span>
                    @endif

                    <div class="titulo"><b>{{$produto->titulo}}</b></div>

                    <div class='div_imagem'>
                        @if ($produto->imgPrincipal == '')
                            <img src="/imagens/produtos/padrao.gif">
                        @else
                            <img src="/imagens/produtos/{{ $produto->imgPrincipal }}">
                        @endif
                    </div>
                    <br />
                    @if ($produto->status == 1)
                        <div class='btn_acoes'>
                            <div><a href="/minha-conta/produto/editar-produto/{{ $produto->id }}" class="btn btn-primary" data-produto-id="{$produto.id}">Editar</a></div>
                            <div><button class="btn btn-danger act-excluir-produto" data-produto-id="{{ $produto->id }}">Excluir</button></div>
                            <div><div class='favorito favorito-ativo'></div></div>
                        </div>
                    @else
                        <div class='btn_acoes'>
                            <div><a href="" class="btn btn-primary" disabled>Editar</a></div>
                            <div><button class="btn btn-danger" disabled >Excluir</button></div>
                            <div><div class='favorito favorito-inativo'></div></div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
