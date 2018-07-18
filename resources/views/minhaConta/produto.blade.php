@extends('template')
@section('content')

    <!--BREADCRUMB-->
    {{-- @include('complements/breadCrumb') --}}
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

    <div class="row hide" id='el-produtos-minha-conta'>
        @if (count($meusProdutos) == 0)
            <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
        @else
            @foreach ($meusProdutos as $produto)
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 div-meus-produtos" align="center">

                    @if ($produto->status == 0)
                        <p><span class="label label-danger">Produto inativo</span></p>
                    @elseif ($produto->status == 1)
                        <p><span class="label label-success">Ativo <b>{{ $produto->dataExibicao }}</b></span></p>
                    @elseif ($produto->status == 2)
                        <p><span class="label label-info"><b>Aguardando aprovação</b></span></p>
                    @elseif ($produto->status == 3)
                        <p><span class="label label-warning">Altera&ccedil;&atilde;o reprovada</b></span></p>
                    @endif

                    <div class="titulo"><b>{{ $produto->titulo }}</b></div>

                    {{-- Produto inativado --}}
                    @if ($produto->status == 0)
                        <div class='div_imagem'><img src="/imagens/produtos/400x400/{{ $produto->imgPrincipal }}" style="filter: contrast(5%);"></div>
                        <br>
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary">Republicar</a></div>
                            <div><button class="btn btn-danger" title='Excluir definitivamente' @click.prevent="deleteProduct({{ $produto->id }})"><span class='glyphicon glyphicon-remove'></span></button></div>
                        </div>
                    {{-- Produto pendente --}}
                    @elseif ($produto->status == 2)
                        <div class='div_imagem' ><img src="/imagens/produtos/400x400/{{ $produto->imgPrincipal }}" style="filter: grayscale(100%)"></div>
                        <br>
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                        </div>
                    {{-- Produto reprovado --}}
                    @elseif ($produto->status == 3)
                        <div class='div_imagem'><img src="/imagens/produtos/400x400/{{ $produto->imgPrincipal }}" style="filter: grayscale(100%)"></div>
                        <br>
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><button class="btn btn-danger" title='Inativar produto' @click.prevent="inactiveProduct({{ $produto->id }})"><span class='glyphicon glyphicon-trash'></span></button></div>
                        </div>
                    {{-- Produto ativo --}}
                    @else
                        <div class='div_imagem'><img src="/imagens/produtos/400x400/{{ $produto->imgPrincipal }}"></div>
                        <br>
                        <div class='btn_acoes'>
                            <div><a href="{{ Route('minha-conta.editar-produto',$produto->slug) }}" class="btn btn-primary" title='Editar produto'><span class='glyphicon glyphicon-pencil'></span></a></div>
                            <div><a href="{{ Route('visualizar-produto',$produto->slug) }}" class="btn btn-success" title='Visualizar produto'><span class='glyphicon glyphicon-eye-open'></span></a></div>
                            <div><button class="btn btn-danger" title='Inativar produto' @click.prevent="inactiveProduct({{ $produto->id }})"><span class='glyphicon glyphicon-trash'></span></button></div>
                            {{-- <div><button class="btn  btn-warning favorito"><div class="favorito-ativo"></div> - {{ $produto->qtd_favorito }}</button></div> --}}
                        </div>
                    @endif
                </div>
            @endforeach

            <br style="clear:both">

            <!--PAGINAÇÃO-->
            <div align='center'>
                @include('complements/paginacao')
            </div>
        @endif
    </div>

    <!--PAGINAÇÃO-->
	{{-- @include('paginacao') --}}
@endsection
