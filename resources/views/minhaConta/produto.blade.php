@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('breadCrumb')

    <div class="row el-produtos-minha-conta hide">
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-md-3 col-xs-12 div-meus-produtos" align="center">

                    @if ($produto->status == 0)
                        <p><span class="label label-danger">Produto inativo</span></p>
                    @elseif ($produto->status == 1)
                        <p><span class="label label-success">Ativo <b>{{ $produto->dataExibicao }}</b></span></p>
                    @elseif ($produto->status == 2)
                        <p><span class="label label-info"><b>Aguardando aprovação</b></span></p>
                    @elseif ($produto->status == 3)
                        <p><span class="label label-warning">Altera&ccedil;&atilde;o reprovada</b></span></p>
                    @endif

                    <div class="titulo"><b>{{$produto->titulo}}</b></div>

                    {{-- Produto inativado --}}
                    @if ($produto->status == 0)
                        <div class='div_imagem'><img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}" style="opacity:0.2"></div>
                        <br />
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary">Republicar</a></div>
                            <div><a href='{{ Route('minha-conta.delete-produto',$produto->id)}}' class="btn btn-danger" title='Excluir definitivamente'><span class='glyphicon glyphicon-remove'></span></a></div>
                        </div>
                    {{-- Produto pendente --}}
                    @elseif ($produto->status == 2)
                        <div class='div_imagem' ><img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}" style="opacity:0.2"></div>
                        <br />
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><button class="btn btn-danger" disabled><span class='glyphicon glyphicon-remove'></span></button></div>
                        </div>
                    {{-- Produto reprovado --}}
                    @elseif ($produto->status == 3)
                        <div class='div_imagem'><img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}" style="opacity:0.2"></div>
                        <br />
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><a href='{{ Route('minha-conta.inativar-produto',$produto->id)}}' class="btn btn-danger" title='Inativar produto'><span class='glyphicon glyphicon-trash'></span></a></div>
                        </div>
                    {{-- Produto ativo --}}
                    @else
                        <div class='div_imagem'><img src="/imagens/produtos/200x200/{{ $produto->imgPrincipal }}"></div>
                        <br />
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><a href="{{ Route('visualizar-produto',$produto->slug) }}" class="btn btn-success" title='Visualizar produto'><span class='glyphicon glyphicon-eye-open'></span></a></div>
                            <div><a href='{{ Route('minha-conta.inativar-produto',$produto->id)}}' class="btn btn-danger" title='Inativar produto'><span class='glyphicon glyphicon-trash'></span></a></div>
                            {{-- <div><button class="btn  btn-warning favorito"><div class="favorito-ativo"></div> - {{ $produto->qtd_favorito }}</button></div> --}}
                        </div>
                    @endif
                </div>
            @endforeach

            <!--PAGINAÇÃO-->
            <br style="clear:both">
            <div align='center'>
                @include('paginacao')
            </div>
        @endif
    </div>

    <!--PAGINAÇÃO-->
	{{-- @include('paginacao') --}}

    <script type="text/javascript" src="/js/site/produto.js"></script>

@endsection
