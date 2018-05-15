@extends('template')
@section('content')

	@if(count($produtos) == 0)
		<div class="well" align="center"><b><i>N&atilde;o existe nenhum produto cadastrado</i></b></div>
	@else
		<div class="row" >
			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 hide" id='el-produtos'>
				<div align="center">
					<h1 align="center" class='msgHome'>Bem vindo ao Brechó Adventure</h1>
					<h3>Confira os novos produtos adicionados recentemente em nosso site.</h3>
				</div>
				<div class="row">
					@foreach($produtos['itens'] as $produto)
						<div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
							<product :data-product="{{ $produto->toJson() }}" :data-user="{{ $produtos['user'] }}" />
						</div>
					@endforeach
				</div>
				<br style="clear:both">
				<br>
				<div align="center">
					<a href="{{ Route('produtos') }}" class="btn btn-primary" style="width: 50%">VER TODOS</a>
				</div>

			</div>
			<aside class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
				<a class="twitter-timeline" data-height="800" data-theme="dark" href="https://twitter.com/Adventure__Club">Tweets Adventure Club</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				{{-- <iframe width="200" height="260" frameborder="0" scrolling="no" src="http://www.webcid.com.br/widgets/meu-calendario-online.php"></iframe> --}}
			</aside>
		</div>
	@endif
@endsection
