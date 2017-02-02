@extends('template')
@section('content')
    <style>
        .favorito{
            background-image: url(/imagens/favorito_ativo.jpg);
			background-size: cover;
			width: 35px;
			height: 35px;
			display:inline-block;
            border:solid 1px #f00;
        }
    </style>

    <ol class="breadcrumb">
		<li><span class='glyphicon glyphicon-home'> Home</span></li>
		<li class="active">Meus Produtos</li>
	</ol>

    <div class="row">
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="border-bottom: solid 1px; padding: 20px 0">
                    @if ($produto->status == 0)
                        <span class="label label-danger">Produto exclu&iacute;do</span>
                    @elseif ($produto->status == 1)
                        <small>Data de cadastro: <b>{{ $produto->created_at }}</b></small>
                    @else
                        <span class="label label-warning"><b>Aguardando aprovação</b></span>
                    @endif
                    {{-- <div style="width: 300px; height: 280px; position: relative;border: solid 1px;"> --}}
                    <div style="width: 250px; height:250px;">
                        @if ($produto->imgPrincipal == '')
                            <img src="/imagens/produtos/padrao.gif" style="width: 100%; height: 100%;">
                        @else
                            <img src="/imagens/produtos/{{ $produto->imgPrincipal }}" style="width: 100%; height: 100%">
                        @endif
                    </div>
                    <br />
                    @if ($produto->status == 1)
                        <div>
                            <a href="/minha-conta/produto/editar-produto/{{ $produto->id }}" class="btn btn-primary" data-produto-id="{$produto.id}">Editar</a>
                            <button class="btn btn-danger act-excluir-produto" data-produto-id="{{ $produto->id }}">Excluir</button>
                            <div class='favorito'></div>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
