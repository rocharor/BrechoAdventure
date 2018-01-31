@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/node_modules/xzoom/dist/xzoom.css" />
	<script src="/node_modules/xzoom/dist/xzoom.min.js"></script>

	<!--BREADCRUMB-->
    @include('breadCrumb')

	<h1>{{ $produto->titulo }}</h1>
	<small style="color:#bbb"><i>Inserido em: {{ $produto->inserido }}</i></small>
	<br><br>

	<div class="row" >
		<div class="col-xs-12 col-sm-10">

			<div class="row">
				<div class="col-md-5">
					<img class="xzoom" src="/imagens/produtos/200x200/{{ $produto->imagens[0] }}" style="width:400px; height:300px" xoriginal="/imagens/produtos/900x900/{{ $produto->imagens[0] }}"/>
					<br><br>
					<div class="xzoom-thumbs">
						@foreach($produto->imagens as $imagem)
							<a href="/imagens/produtos/900x900/{{ $imagem }}">
								<img class="xzoom-gallery" width="80" src="/imagens/produtos/200x200/{{ $imagem }}">
							</a>
						@endforeach
					</div>
				</div>
			</div>

			<h3>Preço: <span style='color:#a00;'>R${{ $produto->valor }}</span></h3>

			<p>{{ $produto->descricao }}</p>
			<hr>
			<p><b>Categoria:</b> {{ $produto->categoria->categoria }}</p>
			<p><b>Estado:</b> {{ $produto->estado }}</p>

			<table class='table table-striped hide'>
				<tr>
					<td><b>Nome:</b></td>
					<td>{{ $produto->user->name }} </td>
				</tr>
				<tr>
					<td><b>E-mail:</b></td>
					<td>{{ $produto->user->email }} </td>
				</tr>
				<tr>
					<td><b>Telefone:</b></td>
					<td>{{ $produto->user->telefone_fixo }} </td>
				</tr>
				<tr>
					<td><b>Celular:</b></td>
					<td>{{ $produto->user->telefone_cel }} </td>
				</tr>
			</table>

			<hr>

			<div class="el-produtos">
				<a href="javascript:window.history.go(-1)" class='btn btn-primary'><span class="glyphicon glyphicon-menu-left"> Voltar</a>
				@if(Auth::check() == 0)
					<button class='btn btn-info' title='Necessário estar logado' disabled><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
				@elseif(Auth::user()->id == $produto->user->id)
					<button class='btn btn-info' title='Este produto é seu' disabled><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
				@else
					<button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
				@endif

				<!--Modal mensagem-->
				<div class="modal fade" id='modal-mensagem'>
					@include('modalMensagem')
				</div>
			</div>

		</div>
	</div>
	<script>
		/* calling script */
	    // $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
	    $('.xzoom, .xzoom-gallery').xzoom({position: '#xzoom2-id', tint: '#ffa200', scroll: false});
	    // $('.xzoom, .xzoom-gallery').xzoom({position: 'lens', lensShape: 'circle', bg:true, sourceClass: 'xzoom-hidden'});
	    // $('.xzoom, .xzoom-gallery').xzoom({tint: '#006699', Xoffset: 15});
	    // $('.xzoom, .xzoom-gallery').xzoom({tint: '#006699', Xoffset: 15});
	</script>

	<script type="text/javascript" src="/js/site/produto.js"></script>
@endsection
