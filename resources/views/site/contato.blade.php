@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('complements/breadCrumb')

    <div class="formulario">
        @include('complements/exibeErro')

	    <form action="/contato/store" method="POST" name="form" id="form">
            {{ csrf_field() }}

	        <div class="form-group">
                @if (Auth::check() == 0)
    	        	<input class="form-control" type="text" name="nome" placeholder="Nome" required="required">
                @else
                    <input class="form-control" type="text" name="nome" placeholder="Nome" required="required" value='{{ Auth::user()->name }}'>
                @endif
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="email" name="email" placeholder="E-mail" required="required">
	        </div>
	        <div class="form-group">
		        <select class="form-control" name="tipo" required="required">
		            <option value=''>--- Escolha uma categoria ---</option>
                    @foreach($data['tipos'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
		        </select>
	        </div>
	        <div class="form-group">
	        	<textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" required="required"></textarea><br>
	        </div>
			<div class="form-group">
				<input type="submit" value="Enviar" class="btn btn-success">
	        	<img src="/imagens/ajax-loader.gif" class="hide carregando" />
	        </div>
	    </form>
    </div>
@endsection
