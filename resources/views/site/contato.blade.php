@extends('template')
@section('content')
<ol class="breadcrumb">
  <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
  <li class="active">Contato</li>
</ol>

<div class="row">
	<div class="col-md-6">
	    <form action="/contato/create" method="POST" name="form" id="form"  {{--onsubmit="validaForm()"--}}>
            {{ csrf_field() }}

	        <div class="form-group">
	        	<input class="form-control" type="text" name="nome" placeholder="Nome" required="required" value="teste">
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="text" name="email" placeholder="E-mail" required="required">
	        </div>
	        <div class="form-group">
		        <select class="form-control" name="tipo" required="required">
		            <option value=''>--- Escolha uma categoria ---</option>
		            <option value='1'>Dúvidas</option>
		            <option value='2'>Reclamações</option>
		            <option value='3'>Sugestões</option>
		            <option value='4'>Elogios</option>
		        </select>
	        </div>
	        <div class="form-group">
	        	<textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required="required"></textarea><br>
	        </div>
			<div class="form-group">
	        	{{-- <input type="button" value="Enviar" class="btn btn-success btn-contato btn-enviar"> --}}
				<input type="submit" value="Enviar" class="btn btn-success">
	        	<img src="/imagens/ajax-loader.gif" class="hide carregando" />
	        </div>
	    </form>
    </div>
</div>


<script type="text/javascript" src="/js/contato.js"></script>
@endsection
