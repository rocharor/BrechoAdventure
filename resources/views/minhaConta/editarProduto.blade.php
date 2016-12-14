@extends('template')
@section('content')
    <h1 class="text-danger">EDITAR PRODUTO</h1>
    <form action="/minha-conta/produto/update/{{ $produto->id }}/" method="post" name="formEditarProduto" enctype="multipart/form-data" style="width: 400px;">
        {{ csrf_field() }}
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
             <input type="text" class="form-control" name="valor" id='valor' value="{{ $produto->valor }}" maxlength="10" required="required" />
         </div>
         <br>

         @foreach($produto->imagens as $key=>$imagem)
    		<div style="width: 150px; height: 150px;">
    			<a class="btn btn-danger act-excluir-foto" data-foto="{{ $imagem }}" data-produto-id="{{ $produto->id }}"  style="position: absolute;">X</a>
    			<img class="img-thumbnail" src="/imagens/produtos/{{ $imagem }}" alt="" style="width: 100%; height: 100%;">
    		</div>
        @endforeach

        <br />

        @if(count($produto->imagens) != 3)
            <div @if (count($produto->imagens) == 0) style="border: solid 1px #f00; padding: 5px" @endif >
                <label>Fotos: </label><small>(Obrigatório no mínimo 1 foto)</small>
                @for ($i = count($produto->imagens); $i < 3; $i++)
                    @if ($i == 0)
                        <input type="file" class="form-control" required='required '/>
                    @else
                        <input type="file" class="form-control" />
                    @endif
                @endfor
            </div>
        @endif

    	<br />
        <input type="submit" class="btn btn-primary" value="Salvar alteração" />
     </form>

    <script type="text/javascript" src="/js/site/produto.js"></script>
@endsection
