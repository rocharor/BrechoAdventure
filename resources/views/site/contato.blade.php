@extends('template')
@section('content')
<ol class="breadcrumb">
  <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
  <li class="active">Contato</li>
</ol>

<div class="row">
	<div class="col-md-6">
	    <!-- {$msg} -->
		@if(isset($msg))
			@if($msg)
				<div class="alert alert-success msg-alert animated" align="center" style="width: auto;">Mensagem enviada com sucesso</div>
			@else
				<div class="alert alert-danger" align="center" style="width: 400px;">Erro ao enviar a mensagem</div>
			@endif
		@endif
	    <form action="/contato" method="POST" name="form" id="form">
            {{ csrf_field() }}

	        <div class="form-group">
	        	<input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" required="required">
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="text" name="email" id="_email" placeholder="E-mail" required="required">
	        </div>
	        <div class="form-group">
		        <select class="form-control" name="tipo" id="tipo" required="required">
		            <option value=''>--- Escolha uma categoria ---</option>
		            <option value='1'>Dúvidas</option>
		            <option value='2'>Reclamações</option>
		            <option value='3'>Sugestões</option>
		            <option value='4'>Elogios</option>
		        </select>
	        </div>
	        <div class="form-group">
	        	<textarea class="form-control" name="mensagem" id="mensagem" rows="5" placeholder="Mensagem" required="required"></textarea><br>
	        </div>
			<div class="form-group">
	        	<input type="button" value="Enviar" class="btn btn-success btn-contato btn-enviar">
				<input type="submit" value="Enviar2" class="btn btn-info">
	        	<img src="/imagens/ajax-loader.gif" class="hide carregando" />
	        </div>
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
	    </form>
    </div>
</div>


<script type="text/javascript" src="/js/contato.js"></script>
@stop
