@extends('template')
@section('content')
    <ol class="breadcrumb">
		<li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
		<li class="active">Cadastro de Produtos</li>
	</ol>
    <div align="center">
        <div align="left" style="width: 500px;">
            @if($autorizado == false)
            	<div class="well">VOCÊ NÃO ESTA AUTORIZADO A CADASTRAR PRODUTOS. FAVOR COMPLETAR SEU PERFIL <a href="{{ Route('minha-conta.mcperfil') }}">CLIQUE AQUI</a></div>
            @else
    	        <form action="{{ Route('minha-conta.storeProduto') }}" method="post" name="form" enctype="multipart/form-data" style="width: 400px;">
                    {{ csrf_field() }}
    	            <div>
    	                <label>Titulo:</label>
    	                <input type="text" class="form-control" name='titulo' required="required" />
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
    	                <input type="file" class="form-control" name='foto[]' onChange="abreCampoFoto(this)" required="required" />
    	                <input type="file" class="form-control hide" name='foto[]' onChange="abreCampoFoto(this)" />
    	                <input type="file" class="form-control hide" name='foto[]' />
    	            </div>
    	            <br>

    	            <div>
    	                <label>Preço:</label>
    	                <input type="text" class="form-control" name='valor' id='valor' maxlength="10" required="required" />
    	            </div>
    	            <br>

    	            <button type="submit" class="btn btn-primary"> Cadastrar </button>
    	            {{-- <button type="button" class="btn btn-primary act-cadastrar-produto"> Cadastrar </button> --}}
    	        </form>
    		@endif
        </div>
    </div>

    {{-- <script type="text/javascript" src="/libs/jquery/jquery.maskMoney.min.js"></script> --}}
    <script type="text/javascript" src="/js/site/cadastroProduto.js"></script>
@endsection
