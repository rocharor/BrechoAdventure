@extends('template')
@section('content')
<link type="text/css" rel="stylesheet" href="/css/produto.css" />

<ol class="breadcrumb">
  <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
  <li class="active">Todos produtos</li>
</ol>

<div class="row" >
	@foreach($produtos as $produto)
		<div class="col-md-3 col-xs-12" align="center" style="border-bottom: solid 1px; padding: 20px 0">
    		<div class="div-produtos" align="center">
    			<div class="div-favorito-{{ $produto->id }}">
    				@if(Auth::check() == 0)
    					<a class="act-favorito-deslogado">
    						<div class="img-inativo"></div>
    					</a>
    				@else
    					@if($produto->favorito)
    						<a class="act-favorito favorito-ativo-{{ $produto->id }}" data-produto-id='{{ $produto->id }}' data-user-id="{{ Auth::user()->id }}" data-status='0'>
    							<span class="img-ativo"></span>
    						</a>
    					@else
    						<a class="act-favorito favorito-inativo-{{ $produto->id }}" data-produto-id='{{ $produto->id }}' data-user-id="{{ Auth::user()->id }}" data-status='1'>
    							<span class="img-inativo"></span>
    						</a>
    					@endif
    				@endif
    			</div>

    			<div  class='titulo' style="height: 20px;" align="center">
    				<b>{{$produto->titulo}}</b>
    			</div>
    			<div style="width: 200px; height: 200px;">
    				<img class="img-thumbnail" src="/imagens/produtos/{{$produto->imgPrincipal}}" alt="" style="width: 100%; height: 100%;">
    			</div>

    			<div><b>Pre&ccedil;o: R$ {{$produto->valor}}</b></div>
    			<div data-id="{{ $produto->id }}">
    				<button class='btn btn-warning act-descricao'><b>Ver detalhes</b></button>
    				@if(Auth::check() != 0)
    					<button class='btn btn-info act-modal-mensagem'><span class="glyphicon glyphicon-envelope"></span></button>
    				@endif
    			</div>
    		</div>
		</div>
	@endforeach
</div>

<!--PAGINAÇÃO-->
<nav align='center'>
  <ul class="pagination">
	 <li>
		 @if($pg == 1)
			<span aria-label="Previous"><span aria-hidden="true">&laquo;</span></span>
		 @else
			<a href="/produto/todosProdutos/{{ $pg - 1 }}" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
		 @endif
	</li>

	@for($i = 1; $i <= $totalProdutos; $i++)
		@if($i == $pg)
			<li class="active"><a>{{ $i }}</a></li>
		@else
			<li><a href="/produto/todosProdutos/{{ $i }}">{{ $i }}</a></li>
		@endif
	@endfor
	 <li>
		 @if($pg == $totalProdutos)
			<span aria-label="Previous"><span aria-hidden="true">&raquo;</span></span>
		 @else
			<a href="/produto/todosProdutos/{{ $pg + 1 }}" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
		 @endif
	</li>
  </ul>
</nav>


<!--Modal descricao-->
<div class="modal fade" id='modal_descricao'>
	@include('modalDescricao')
</div>

<script type="text/javascript" src="/js/site/produto.js"></script>
<script type="text/javascript" src="/js/site/favorito.js"></script>
@stop
