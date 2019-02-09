@extends('template')

@section('content')

    <div id='el-my-favorites' class='hide'>
		<!--BREADCRUMB-->
		<div id='breadcrumb'>
			<breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
		</div>

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
						<td><img src="/images/products/{{ $favorito->produto->imgPrincipal }}" width="60px" height="60px"/></td>
						<td>R$ {{ $favorito->produto->valor }}</td>

						<td><a  href='{{ Route('product-view',$favorito->produto->slug) }}' class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a></td>
						<td><button class="btn btn-danger" @click.prevent="deleteFavorite({{ $favorito->id }})"><span class="glyphicon glyphicon-trash"></span></button></td>
						<td><modal-contact :auth="{{ Auth::check() ? 1 : 0 }}" :product-id="{{ $favorito->produto->id }}" :icon="true"/></td>
					</tr>
				@endforeach
			</table>

			<!--PAGINAÇÃO-->
			<div align='center'>
				<pagination pg="{{ $pg }}" link="{{ $link }}" number-pages="{{ $numberPages }}" />
			</div>
		@endif

	</div>
@endsection
