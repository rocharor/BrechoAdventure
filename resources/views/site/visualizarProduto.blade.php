@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/produto.css" />
	{{-- <script src='https://code.jquery.com/jquery-1.12.4.min.js'></script> --}}
	<link type="text/css" rel="stylesheet" href="/libs/xZoom/dist/xzoom.css" />
	<script src="/libs/xZoom/dist/xzoom.min.js"></script>

	<!--BREADCRUMB-->
    @include('breadCrumb')

	<h1>{{ $produto->titulo }}</h1>

	<div class="row" >
		<div class="col-xs-12 col-sm-10">

			<div class="row">
				<div class="col-md-5">
					<img class="xzoom" src="/imagens/produtos/200x200/{{ $produto->imagens[0] }}" style="width:500px; height:400px" xoriginal="/imagens/produtos/900x900/{{ $produto->imagens[0] }}"/>

					<div class="xzoom-thumbs">
						@foreach($produto->imagens as $imagem)
							<a href="/imagens/produtos/900x900/{{ $imagem }}">
								<img class="xzoom-gallery" width="80" src="/imagens/produtos/200x200/{{ $imagem }}">
							</a>
						@endforeach
					</div>
				</div>
			</div>
			
			<table class='table table-striped'>
				<tr>
					<td><b>Nome:</b></td>
					{{-- <td>{{ $produto->name }} </td> --}}
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
				<tr><td colspan=2></td></tr>
				<tr>
					<td><b>Titulo:</b></td>
					<td>{{ $produto->titulo }} </td>
				</tr>
				<tr>
					<td><b>Categoria:</b></td>
					<td>{{ $produto->categoria->categoria }} </td>
				</tr>
				<tr>
					<td><b>Estado:</b></td>
					<td>{{ $produto->estado }} </td>
				</tr>
				<tr>
					<td><b>Valor:</b></td>
					<td>{{ $produto->valor }} </td>
				</tr>
				<tr>
					<td><b>Descrição:</b></td>
					<td>{{ $produto->descricao }} </td>
				</tr>
				<tr><td colspan=2></td></tr>
			</table>

			<hr>

			<div class="el-produtos">
				<a href="javascript:window.history.go(-1)" class='btn btn-primary'><span class="glyphicon glyphicon-menu-left"> Voltar</a>

				@if(Auth::check() != 0)
					<button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span> Envia mensagem</button>
				@endif
			</div>

			<!--Modal mensagem-->
			<div class="modal fade" id='modal-mensagem'>
				@include('modalMensagem')
			</div>
		</div>
	</div>
	<script>
		/* calling script */
	    $('.xzoom, .xzoom-gallery').xzoom({zoomWidth: 400, title: true, tint: '#333', Xoffset: 15});
	    // $('.xzoom, .xzoom-gallery').xzoom({position: '#xzoom2-id', tint: '#ffa200'});
	    // $('.xzoom, .xzoom-gallery').xzoom({position: 'lens', lensShape: 'circle', bg:true, sourceClass: 'xzoom-hidden'});
	    // $('.xzoom, .xzoom-gallery').xzoom({tint: '#006699', Xoffset: 15});
	    // $('.xzoom, .xzoom-gallery').xzoom({tint: '#006699', Xoffset: 15});
	</script>
	<script type="text/javascript" src="/js/site/produto.js"></script>
@endsection
