@extends('admin/template')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Visualização de produto</li>
        </ol>
    </section>

    <section class="content">
    	<div class="row" >
    		<div class="col-xs-12 col-sm-10">
    			<table class='table table-hover'>
    				<tr>
    					<td><b>Titulo:</b></td>
    					<td>{{ $data['produto']->titulo }} </td>
    				</tr>
    				<tr>
    					<td><b>Categoria:</b></td>
    					<td>{{ $data['produto']->categoria->categoria }} </td>
    				</tr>
    				<tr>
    					<td><b>Descrição:</b></td>
    					<td>{{ $data['produto']->descricao }} </td>
    				</tr>
    				<tr>
    					<td><b>Estado:</b></td>
    					<td>{{ $data['produto']->estado }} </td>
    				</tr>
    				<tr>
    					<td><b>Preço:</b></td>
    					<td>R${{ $data['produto']->valor }} </td>
    				</tr>
    			</table>

                <div class="">
                    @foreach($data['produto']->imagens as $imagem)
                        <img src="/imagens/produtos/200x200/{{ $imagem }}" style="width:80px; height:80px">
                    @endforeach
                </div>

                <br>

                <form action="{{ Route('admin.pendente.product-status') }}" method="post">
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="{{ $data['produto']->id }}">
                    <button class='btn btn-success' type="submit" name="status" value='1'>Aprovar</button>
                    <button class='btn btn-danger' type="submit" name="status" value='3'>Reprovar</button>
                </form>

    		</div>
    	</div>
    </section>

@endsection
