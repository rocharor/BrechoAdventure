@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/produto.css" />

	<ol class="breadcrumb">
		<li class="active"><span class='glyphicon glyphicon-home'> Home</span></li>
	</ol>

	@if(count($produtos) == 0)
		<div class="well" align="center"><b><i>N&atilde;o existe nenhum produto cadastrado</i></b></div>
	@else
		<div class="row" >
			<div class="col-xs-12 col-sm-10">
				<h1 class="text-success" align="center">Novidades</h1>
				<p>Confira os novos produtos adicionados recentemente em nosso site.</p>
				<p>Fique sempre atento em nossa promoções :)</p>
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

							<div class='titulo' style="height: 20px;" align="center">
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
			<div class="col-sm-2 hidden-xs" style="border:solid 1px; height:500px">
				Anuncios
			</div>
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

	<!--Modal mensagem-->
	<div class="modal fade" id='modal-mensagem'>
		@include('modalMensagem')
	</div>

	<script type="text/javascript" src="/js/site/produto.js"></script>
	<script type="text/javascript" src="/js/site/favorito.js"></script>
	<script type="text/javascript" src="/js/site/mensagem.js"></script>
@endsection
