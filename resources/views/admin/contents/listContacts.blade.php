@extends('admin/template')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Contatos pendentes</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if (count($data['contatosPendentes']) == 0)
                    <div class="well" align="center"><b><i>Sem contatos pendentes</i></b></div>
                @else
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Produtos pendentes</h3>
                        </div>

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                                @foreach($data['contatosPendentes'] as $contato)
                                    <tr>
                                        <td>{{ $contato->id }}</td>
                                        <td>{{ $contato->tipo }}</td>
                                        <td>{{ $contato->created_at }}</td>
                                        <td><a href='{{ Route('admin.pendente.contact-view', $contato->id) }}' class='btn btn-primary'><span class="glyphicon glyphicon-eye-open"></span></a></td>
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
