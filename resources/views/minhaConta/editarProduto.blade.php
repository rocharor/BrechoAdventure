@extends('template')
@section('content')

	<!--BREADCRUMB-->
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

    {{-- <div class='formulario hide' id='el-produtos-minha-conta'> --}}
    <div class='formulario'>
        @include('complements/exibeErro')

        <form action="/minha-conta/produto/update" method="post" name="formEditarProduto" enctype="multipart/form-data">
            {{ csrf_field() }}

			<input type="hidden" name="produto_id" value="{{ $produto->id }}">
            <br />

			@if ($produto->status == 0)
				<p><span class="label label-danger">Produto inativo</span></p>
			@elseif ($produto->status == 1)
				<p><span class="label label-success">Ativo <b>{{ $produto->dataExibicao }}</b></span></p>
			@elseif ($produto->status == 2)
				<p><span class="label label-info"><b>Aguardando aprovação</b></span></p>
			@elseif ($produto->status == 3)
				<p><span class="label label-warning">Altera&ccedil;&atilde;o reprovada</b></span></p>
			@endif
            <br>

            <div>
                 <label>Titulo:</label>
                 <input type="text" class="form-control" name='titulo' value="{{ $produto->titulo }}" required="required" />
            </div>
			<br>

            <div>
                 <label>Categoria:</label>
                 <select class="form-control" name="categoria" required="required">
                     @foreach ($categorias as $categoria)
                     	@if ($categoria->id == $produto->categoria_id)
                     		<option value='{{ $categoria->id }}' selected="selected">{{ $categoria->categoria }}</option>
                     	@else
                     		<option value='{{ $categoria->id }}'>{{ $categoria->categoria }}</option>
                     	@endif
                    @endforeach
                 </select>
             </div>
             <br>

             <div>
                 <label>Descrição:</label>
                 <textarea name="descricao" class="form-control" rows="5" required="required">{{ $produto->descricao }}</textarea>
             </div>
             <br>

             <div>
                 <label>Estado do Produto:</label><br>
                 @if ($produto->estado == 'novo')
        	         <label><input type="radio" class="tipo_produto" name="estado" value="novo" checked="checked"> - Novo:</label><br>
        	         <label><input type="radio" class="tipo_produto" name="estado" value="usado"> - Usado:</label>
                 @else
                 	 <label><input type="radio" class="tipo_produto" name="estado" value="novo"> - Novo:</label><br>
        	         <label><input type="radio" class="tipo_produto" name="estado" value="usado" checked="checked"> - Usado:</label>
                 @endif
             </div>
             <br>

             <div>
                 <label>Preço:</label>
                 <input type="text" class="form-control" name="valor" id='valor' value="{{ $produto->valor }}" maxlength="10" required="required" style="width:150px" />
             </div>
             <br>

             @foreach($produto->imagens as $key=>$imagem)
        		<div style="width: 150px; height: 150px; display:inline-block;">
                    @if ($imagem != 'sem-imagem.gif')
                        <button class="btn btn-danger" @click.prevent="deletePhoto('{{ $imagem }}', {{ $produto->id }})" style="position: absolute;">X</button>
                    @endif
        			{{-- <img class="img-thumbnail" src="/imagens/produtos/400x400/{{ $imagem }}" alt="" style="width: 100%; height: 100%;"> --}}
        			<img class="img-thumbnail" src="/images/products/{{ $imagem }}" alt="" style="width: 100%; height: 100%;">
        		</div>
            @endforeach
            <br>

            @if(count($produto->imagens) != 3)
                <div @if (count($produto->imagens) == 0) style="border: solid 1px #f00; padding: 5px" @endif >
                    <br />
                    <label>Fotos: </label><small>(Obrigatório no mínimo 1 foto)</small>
                    @for ($i = count($produto->imagens); $i < 3; $i++)
                        @if ($i == 0)
                            <input type="file" name='imagemProduto[]' class="form-control" required='required '/>
                        @else
                            <input type="file" name='imagemProduto[]' class="form-control" />
                        @endif
                    @endfor
                    <p><span class="label label-warning"><b class='text-danger'>Tamanho ideal para fotos ( 1000 x 1000 )</b></span></p>
                </div>
            @endif
        	<br>

            @if ($produto->status == 1)
                <a href='{{ Route('visualizar-produto',$produto->slug) }}' class="btn btn-info">Visualizar</a>
            @else
                <button class="btn btn-info" disabled>Visualizar</button>
            @endif
            <input type="submit" class="btn btn-success" value="Salvar alteração" />
         </form>
     </div>
@endsection
