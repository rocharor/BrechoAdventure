@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('complements/breadCrumb')

    <div class="row" >
        <aside class="col-lg-3 col-md-3 col-sm-4 hidden-xs" style="border:solid 0px; padding:0">
            @include('complements/filtroLateral')
        </aside>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 hide" id='el-produtos'>
        	@foreach($produtos as $produto)
        		<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" align="center" style="padding: 20px 0">
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
                            @if(Auth::check() == 0)
                                <button class='btn btn-info' title='Necessário estar logado' disabled><span class="glyphicon glyphicon-envelope"></span></button>
                            @elseif(Auth::user()->id == $produto->user->id)
                                <button class='btn btn-info' title='Este produto é seu' disabled><span class="glyphicon glyphicon-envelope"></span></button>
                            @else
                                <button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span></button>
                            @endif
                        </div>
            		</div>
        		</div>
        	@endforeach

            <!--PAGINAÇÃO-->
            <br style="clear:both">
            <div align='center'>
                @include('complements/paginacao')
            </div>

            <!--Modal mensagem-->
            <div class="modal fade" id='modal-mensagem'>
                @include('complements/modalMensagem')
            </div>
        </div>
    </div>

    <script>
        $(function(){
            appVueFiltro.buscaDadosFiltro();
        })
    </script>
@endsection
