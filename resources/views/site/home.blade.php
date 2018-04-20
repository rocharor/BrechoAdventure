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
				@foreach($produtos as $produto)
					@include('complements/catalogProducts')
				@endforeach
				<br style="clear:both">
				<br>
				<div align="center">
					<a href="{{ Route('produtos') }}" class="btn btn-primary" style="width: 50%">VER TODOS</a>
				</div>

				<!--Modal mensagem-->
				<div class="modal fade" id='modal-mensagem'>
					@include('complements/modalMensagem')
				</div>
			</div>
			<aside class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
				<a class="twitter-timeline" data-height="800" data-theme="dark" href="https://twitter.com/Adventure__Club">Tweets Adventure Club</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				{{-- <iframe width="200" height="260" frameborder="0" scrolling="no" src="http://www.webcid.com.br/widgets/meu-calendario-online.php"></iframe> --}}
			</aside>
		</div>
	@endif
@endsection
