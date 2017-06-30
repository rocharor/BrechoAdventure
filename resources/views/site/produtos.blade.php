@extends('template')
@section('content')
    <link type="text/css" rel="stylesheet" href="/css/produto.css" />

    <!--BREADCRUMB-->
    @include('breadCrumb')

    <div class="row" >
        <div class="col-sm-2 hidden-xs" style="border:solid 0px; padding:0">
            @include('filtroLateral')
            {{-- <iframe width="200" height="260" frameborder="0" scrolling="no" src="http://www.webcid.com.br/widgets/meu-calendario-online.php"></iframe>             --}}
        </div>
        <div class="col-xs-12 col-sm-10 el-produtos hide">
        	@foreach($produtos as $produto)
        		<div class="col-md-3 col-xs-12" align="center" style="border-bottom: solid 1px; padding: 20px 0">
            		<div class="div-produtos" align="center">
            			<div class="div-favorito-{{ $produto->id }}">
            				@if(Auth::check() == 0)
            					<a class="act-favorito-deslogado">
            						<div class="img-inativo"></div>
            					</a>
            				@else
                                <a class="produto-{{ $produto->id }}" @click.prevent='setFavorite({{ $produto->id }})'>
                                    @if($produto->favorito)
                                        <span class="img-ativo"></span>
                                    @else
                                        <span class="img-inativo"></span>
                                    @endif
                                </a>
            				@endif
            			</div>

            			<div  class='titulo' style="height: 20px;" align="center">
            				<b>{{$produto->titulo}}</b>
            			</div>
            			<div style="width: 200px; height: 200px;">
            				<img class="img-thumbnail" src="/imagens/produtos/200x200/{{$produto->imgPrincipal}}" alt="" style="width: 100%; height: 100%;">
            			</div>

            			<div><b>Pre&ccedil;o: R$ {{$produto->valor}}</b></div>
                        <div>
                            <a href='{{ Route('visualizar-produto',$produto->slug) }}' class='btn btn-warning'><b>Ver detalhes</b></a>
                            @if(Auth::check() != 0)
                                <button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span></button>
                            @endif
                        </div>
            		</div>
        		</div>
        	@endforeach

            <!--Modal descricao-->
            {{-- <div class="modal fade" id='modal_descricao'>
            	@include('modalDescricao')
            </div> --}}

            <!--Modal mensagem-->
            <div class="modal fade" id='modal-mensagem'>
                @include('modalMensagem')
            </div>

        </div>
    </div>

    <!--PAGINAÇÃO-->
    @include('paginacao')

    <script type="text/javascript" src="/js/site/produto.js"></script>
@endsection
