    @extends('template')
@section('content')
    <h1 class="text-danger">MEUS PRODUTOS</h1>
    <div class="row">
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4" style="border: solid 0px;">
                    <div style="width: 300px; height: 20px;">
                        @if ($produto->status == 0)
                            <span class="label label-danger">Produto exclu&iacute;do</span>
                        @elseif ($produto->status == 1)
                            Data de cadastro: <b>{{ $produto->created_at }}</b>
                        @else
                            <span class="label label-warning"><b>Aguardando aprovação</b></span>
                        @endif
                    </div>
                    <div style="width: 300px; height: 280px; position: relative;">
                        @if ($produto->imgPrincipal == '')
                            <img src="/imagens/produtos/padrao.gif" style="width: 90%; height: 90%;">
                        @else
                            <img src="/imagens/produtos/{{ $produto->imgPrincipal }}" style="width: 90%; height: 90%;">
                        @endif
                    </div>
                    @if ($produto->status == 1)
                        <div>
                            <a href="/minha-conta/meus-produtos/meusProdutosEditar/produto/{{ $produto->id }}" class="btn btn-success" data-produto-id="{$produto.id}">Editar</a>
                            <button class="btn btn-danger act-excluir-produto" data-produto-id="{{ $produto->id }}">Excluir</button>
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <script type="text/javascript" src="/libs/jquery/jquery.maskMoney.min.js"></script>
    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
