@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/produto.css" />

	<ol class="breadcrumb">
		<li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
		<li class="active">Visualizar produtos</li>
	</ol>

	<p><b>Nome:</b> {{ $produto->name }}</p>
	<p><b>E-mail:</b> {{ $produto->email }}</p>
	<p><b>Telefone:</b> {{ $produto->telefone_fixo }}</p>
	<p><b>Celular:</b> {{ $produto->telefone_cel }}</p>

	<p><b>Titulo:</b> {{ $produto->titulo }}</p>
	<p><b>Categoria:</b> {{ $produto->categoria }}</p>
	<p><b>Estado:</b> {{ $produto->estado }}</p>
	<p><b>Valor:</b> {{ $produto->valor }}</p>

	<p><b>Fotos:</b> {{ $produto->nm_imagem }}</p>

	<script type="text/javascript" src="/js/site/produto.js"></script>
	<script type="text/javascript" src="/js/site/mensagem.js"></script>
@endsection
