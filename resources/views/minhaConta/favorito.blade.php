@extends('template')
@section('content')

	<!--BREADCRUMB-->
    {{-- @include('complements/breadCrumb') --}}
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

	<div class="hide" id='el-favorito'>
	    @if(count($favoritos) == 0)
	         <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui nenhum favorito cadastrados</i></b></div>
	    @else
	    	<table class="table table-striped">
	    	    <tr>
	    	        <td style="width: 300px;"><b>Titulo</b></td>
	    	        <td style="width: 520px;"><b>Descrição</b></td>
	    	        <td><b>Foto</b></td>
	                <td style="width: 100px;"><b>Valor</b></td>
	    	        <td colspan="3"><b>Ações</b></td>
	    	    </tr>
	            @foreach($favoritos as $favorito)
	    	        <tr>
	    	            <td>{{ $favorito->produto->titulo }}</td>
	    	            <td>{{ $favorito->produto->descricao }}</td>
	                    <td><img src="/imagens/produtos/200x200/{{ $favorito->produto->imgPrincipal }}" width="60px" height="60px"/></td>
	                    <td>R$ {{ $favorito->produto->valor }}</td>

	    	            <td><a  href='{{ Route('visualizar-produto',$favorito->produto->slug) }}' class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a></td>
	    	            <td><button class="btn btn-danger" @click.prevent="deleteFavorite({{ $favorito->id }})"><span class="glyphicon glyphicon-trash"></span></button></td>
	    	            <td><button class='btn btn-info act-modal-mensagem'><span class="glyphicon glyphicon-envelope"></span></button></td>

	    	        </tr>
	    	    @endforeach
	    	</table>

			<!--PAGINAÇÃO-->
			@include('complements/paginacao')
	    @endif
	</div>
@endsection
