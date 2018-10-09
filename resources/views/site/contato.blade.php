@extends('template')
@section('content')
	<div id='el-contact' class='hide'>
		{{-- BREADCRUMB --}}
		<div id='breadcrumb'>
			<breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
		</div>

		<div class="formulario">
			@include('complements/exibeErro')

			<form action="/contato/store" method="post" id='myForm' v-on:submit.prevent="onSubmit">
				{{ csrf_field() }}
				
				<div class="form-group">
						<input class="form-control" type="text" name='name' placeholder="Nome" v-model='dataContact.name'>
				</div>

				<div class="form-group">
					<input class="form-control" type="email" name='email' placeholder="E-mail" v-model='dataContact.email'>
				</div>

				<div class="form-group">
					<select class="form-control" name='category' v-model='dataContact.category'>
						<option value=''> --- Escolha uma categoria --- </option>
						@foreach($data['tipos'] as $key => $value)
							<option value='{{ $key }}'>{{ $value }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<textarea class="form-control" name="message" rows="5" placeholder="Mensagem" v-model='dataContact.message'></textarea>
				</div>

				<br>

				<div class="form-group">
					<input type="submit" value="Enviar" class="btn btn-success" >
					<img src="/imagens/ajax-loader.gif" class="carregando" :class="{hide: imgLoader == false}" />
				</div>
			</form>
		</div>
	</div>
@endsection
