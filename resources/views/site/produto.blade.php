@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/produto.css" />

	<style type="text/css">
		.img-ativo  {
			background-image: url(/imagens/favorito_ativo.jpg);
			background-size: cover;
			width: 20px;
			height: 20px;
			display:block;
		}
		.img-inativo  {
			background-image: url(/imagens/favorito_inativo.jpg);
			background-size: cover;
			width: 20px;
			height: 20px;
			display:block;
		}
	</style>

	<ol class="breadcrumb">
		<li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
		<li class="active">Produtos</li>
	</ol>

	@if(count($produtos) == 0)
		<div class="well" align="center"><b><i>N&atilde;o existe nenhum produto cadastrado</i></b></div>
	@else
		<div class="row" >
			<h1 class="text-success" align="center">Ultimos produtos adicionados</h1>
			@foreach($produtos as $produto)
				<div class="col-md-4" align="center" style="border-bottom: solid 1px; padding: 20px 0">
				<div class="div-produto" align="center">
					<div class="div-favorito-{{ $produto->id }}">
						@if(Auth::check() == 0)
							<a class="act-favorito-deslogado"><img src="/imagens/favorito_inativo.jpg" alt="" style="width: 20px;"></a>
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
					<div style="width: 300px; height: 20px;" align="center">
						<b>{{$produto->titulo}}</b>
					</div>
					<div style="width: 250px; height: 250px;">
						<!-- <img class="img-thumbnail" src="/imagens/produtos/{$produto.img_principal}" alt="" style="width: 100%; height: 100%;"> -->
						<img class="img-thumbnail" src="/imagens/produtos/{{$produto->imgPrincipal}}" alt="" style="width: 100%; height: 100%;">
					</div>
					<div><b>Pre&ccedil;o: R$ {{$produto->valor}}</b></div>
					<div><button style="width:100%;" class='btn btn-warning act-descricao' data-id="{{$produto->id}}"><b>Ver detalhes</b></button></div>
				</div>
				</div>
			@endforeach
		</div>
		<br><br>
		<div align="center">
			<a href="/produto/todosProdutos/1" class="btn btn-primary" style="width: 50%">VER TODOS</a>
		</div>
	@endif

	<!--Modal descricao-->
	<div class="modal fade" id='modal_descricao'>
		@include('modalDescricao')
	</div>

	<script type="text/javascript" src="/js/site/produto.js"></script>
	<script type="text/javascript" src="/js/site/favorito.js"></script>
@endsection
