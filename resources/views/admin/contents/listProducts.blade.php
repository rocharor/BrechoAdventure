@extends('admin/template')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Produtos pendentes</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if (count($data['produtosPendentes']) == 0)
                    <div class="well" align="center"><b><i>Sem produtos pendentes</i></b></div>
                @else
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Produtos pendentes</h3>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Categoria</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                @foreach($data['produtosPendentes'] as $produto)
                                    <tr>
                                        <td>{{ $produto->id }}</td>
                                        <td>{{ $produto->titulo }}</td>
                                        <td>{{ $produto->categoria->categoria }}</td>
                                        <td>{{ $produto->updated_exibica }}</td>
                                        <td><a href='{{ Route('admin.product-view', $produto->id) }}' class='btn btn-primary'><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
