@extends('template')

@section('content')
    <!--BREADCRUMB-->
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

    <div class="formulario hide" id="el-contato">
        {{-- @include('complements/exibeErro') --}}
	    {{-- <form action="/contato/store" method="post" name="form" v-on:submit.prevent="onSubmit"> --}}
	    <form action="/contato/store" method="post" name="form" v-on:submit.prevent="onSubmit">
	        <div class="form-group">
                {{-- @if (Auth::check() == 0) --}}
    	        	<input class="form-control" type="text" name="nome" v-model="teste">
    	        	{{-- <input class="form-control" type="text" name="nome" v-model="dataContact.message"> --}}
                {{-- @else --}}
                    {{-- <input class="form-control" type="text" name="nome" placeholder="Nome"  value='{{ Auth::user()->name }}'> --}}
                {{-- @endif --}}
	        </div>
	        <div class="form-group">
	        	<input class="form-control" type="email" name="email" placeholder="E-mail" >
	        </div>
	        <div class="form-group">
		        <select class="form-control" name="tipo" >
		            <option value=''>--- Escolha uma categoria ---</option>
                    @foreach($data['tipos'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
		        </select>
	        </div>
	        <div class="form-group">
	        	<textarea class="form-control" name="mensagem" rows="5" placeholder="Mensagem" ></textarea><br>
	        </div>
			<div class="form-group">
				<input type="submit" value="Enviar" class="btn btn-success" >
	        	<img src="/imagens/ajax-loader.gif" class="carregando" :class="{hide: imgLoader == false}" />
	        </div>
	    </form>
    </div>
@endsection
