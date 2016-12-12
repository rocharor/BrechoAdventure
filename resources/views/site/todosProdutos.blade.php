@extends('template')
@section('content')
<link type="text/css" rel="stylesheet" href="/css/produto.css" />

<style type="text/css">
/*.img-ativo  {
    background-image: url(/imagens/favorito_ativo.jpg);
    background-size: cover;
    width: 20px;
    height: 20px;

}
.img-inativo  {
    background-image: url(/imagens/favorito_inativo.jpg);
    background-size: cover;
    width: 20px;
    height: 20px;

}*/
</style>

<ol class="breadcrumb">
  <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
  <li><a href="/produto/">Produto</a></li>
  <li class="active">Todos produtos</li>
</ol>

<div class="row">
	<div class="col-lg-12">
			<div class="row">
				@foreach($produtos as $produto)
					<div class="col-md-4 div-produto" align='center'  style="border-bottom: solid 1px; padding: 20px 0">
						<div class="div-favorito-{$produto.id}" data-usuario-id="{$usuario_id}">
							@if(Auth::check() == 0)
								<a class="act-favorito-deslogado">
                                    <div class="img-inativo"></div>
                                </a>
							@else
								@if($produto->favorito)
									<a class="act-favorito favorito-ativo-{{ $produto->id }}" data-produto-id='{{ $produto->id }}' data-status='0'>
										<div class="img-ativo"></div>
									</a>
								@else
									<a class="act-favorito favorito-inativo-{{ $produto->id }}" data-produto-id='{{ $produto->id }}' data-status='1'>
										<div class="img-inativo"></div>
									</a>
								@endif
							@endif
						</div>
						<div style="width: 300px; height: 20px;" align="center">
							<b>{{$produto->titulo}}</b>
						</div>
						<div style="width: 250px; height: 250px;">
							<img class="img-thumbnail" src="/imagens/produtos/{{ $produto->imgPrincipal }}" alt="" style="width: 100%; height: 100%;">
						</div>
						<div><b>Pre&ccedil;o: R$ {{ $produto->valor }}</b></div>
						<div><button style=":width100%;" class='btn btn-warning act-descricao' data-id="{{ $produto->id }}"><b>Ver detalhes</b></button></div>
					</div>
				@endforeach
			</div>
		</div>
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
