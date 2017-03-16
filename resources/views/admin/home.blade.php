@extends('template')
@section('content')
	<link type="text/css" rel="stylesheet" href="/css/admin.css" />

	<div class='row'>
		{{-- PROVISORIO --}}
			<p><a href='/cache/atualizar' target='_blank' class='btn btn-danger' name="button">Atualizar Cache Produtos</a></p>
		{{-- FIM PROVISORIO --}}

		<div class='col-md-6'>
			<table class="table table-hover">
				<thead>
					<tr class='titulo-adm'>
						<td colspan="3">Gerência dos Produtos</td>
					</tr>
					<tr>
						<td><b>Conteúdo</b></td>
						<td><b>QTD</b></td>
						<td><b>Visualizar</b></td>
					</tr>

				</thead>
				<tbody>
					{{-- {foreach from=$dados.produtos key=chave item=produto} --}}
						<tr>
							<td>{$chave}</td>
							<td>{$produto.qtd}</td>
							<td><a href='/admin/produto/{$produto.status}/' class='btn btn-primary glyphicon glyphicon-eye-open'></a></td>
						</tr>
					{{-- {/foreach} --}}
				</tbody>
			</table>
		</div>

		<div class='col-md-6 adm'>
			<table class="table table-hover">
				<thead>
					<tr class='titulo-adm'>
						<td colspan="3">Gerência das Mensagens</td>
					</tr>
					<tr>
						<td><b>Conteúdo</b></td>
						<td><b>QTD</b></td>
						<td><b>Visualizar</b></td>
					</tr>

				</thead>
				<tbody>
					{{-- {foreach from=$dados.mensagens key=chave item=mensagem} --}}
						<tr>
							<td>{$chave}</td>
							<td>{$mensagem.qtd}</td>
							<td><a href='/admin/mensagem/{$mensagem.tipo}/' class='btn btn-primary glyphicon glyphicon-eye-open'></a></td>
						</tr>
					{{-- {/foreach} --}}
				</tbody>
			</table>
		</div>
	</div>
@endsection
