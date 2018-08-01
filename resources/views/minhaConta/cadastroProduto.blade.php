@extends('template')
@section('content')

	<!--BREADCRUMB-->
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

    @if($autorizado == false)
    	<div class="well">VOCÊ NÃO ESTA AUTORIZADO A CADASTRAR PRODUTOS. FAVOR COMPLETAR SEU PERFIL <a href="{{ Route('minha-conta.perfil') }}">CLIQUE AQUI</a></div>
    @else
		<div class='formulario'>
	        <form action="{{ Route('minha-conta.store-produto') }}" method="post" name="form" enctype="multipart/form-data">
                {{ csrf_field() }}

	            <div>
	                <label>Titulo:</label>
	                <input type="text" class="form-control" name='titulo' required="required" maxlength='100' />
	            </div>
	            <br>

	            <div>
	                <label>Categoria:</label>
	                <select class="form-control" name="categoria" required="required">
	                    @foreach($categorias as $categoria)
			            		<option value='{{ $categoria->id }}'>{{ $categoria->categoria }}</option>
			            @endforeach
	                </select>
	            </div>
	            <br>

	            <div>
	                <label>Descrição:</label>
	                <textarea name="descricao" class="form-control" rows="5" required="required"></textarea>
	            </div>
	            <br>

	            <div>
	                <label>Tipo de Produto:</label><br>
	                <label><input type="radio" class="tipo_produto" name="tipo" value="novo" required="required"> - Novo:</label><br>
	                <label><input type="radio" class="tipo_produto" name="tipo" value="usado" required="required"> - Usado:</label>
	            </div>
	            <br><br>

	            <div>
	                <label>Fotos: </label><small>(Obrigatório no mínimo 1 foto)</small>
	                <input type="file" class="form-control" name='foto[]' required="required" />
	                <input type="file" class="form-control" name='foto[]' />
	                <input type="file" class="form-control" name='foto[]' />
	                {{-- <input type="file" class="form-control" name='foto[]' onChange="abreCampoFoto(this)" required="required" />
	                <input type="file" class="form-control hide" name='foto[]' onChange="abreCampoFoto(this)" />
	                <input type="file" class="form-control hide" name='foto[]' /> --}}
	            </div>
	            <br>

	            <div>
	                <label>Preço:</label>
	                <input type="text" class="form-control" name='valor' id='valor' maxlength="10" required="required" style="width:150px"/>
	            </div>
	            <br>

	            <button type="submit" class="btn btn-primary"> Cadastrar </button>
	        </form>
		</div>
	@endif

	{{-- < script> --}}
		{{-- // function abreCampoFoto(obj){
		//     $(obj).next().removeClass('hide')
		// }

		// Mascaras
		// (function() {
		//     if (document.getElementById("valor") != null) {
		//         VMasker(document.getElementById("valor")).maskMoney();
		//     }
		// })(); --}}

	{{-- < /script> --}}
@endsection
