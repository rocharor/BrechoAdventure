@extends('admin/template')
@section('content')
    {{-- <link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap.css"> --}}
    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div style="margin-bottom:20px; width:300px">
                    <button class='btn btn-primary act-mostra-form'>Novo</button>

                    <form class="form-role hide" action="{{ Route('admin.acl-store-role') }}" method="post">
                        {{ csrf_field() }}

                        <input type="text" class='form-control' name="nome" placeholder='Nome da role'>
                        <input type="text" class='form-control' name="descricao" placeholder='Descrição da role'>
                        <br>
                        <button type="submit" class='btn btn-success'>Salvar</button>
                        <button type="button" class='btn btn-danger act-cancela-form'>Cancelar</button>
                    </form>
                </div>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    <div class="box-body">
                        <table id="table-roles" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th colspan="2">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['roles'] as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->label }}</td>
                                        <td style="width:50px"><a href='#' class="btn btn-primary" disabled><span class="glyphicon glyphicon-pencil"></span></a></td>
                        	            <td style="width:50px"><a href='{{ Route('admin.acl-destroy-role', $value->id) }}' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script> --}}

    <script>
        $('.act-mostra-form').on('click',function(){
            $('.act-mostra-form').addClass('hide');
            $('.form-role').removeClass('hide');
        })

        $('.act-cancela-form').on('click',function(){
            $('.act-mostra-form').removeClass('hide');
            $('.form-role').addClass('hide');
        })

      {{-- $(function () { --}}
        {{-- $('#table-roles').DataTable({ --}}
          {{-- "paging": true, --}}
          {{-- "lengthChange": false, --}}
          {{-- "searching": false, --}}
          {{-- "ordering": true, --}}
          {{-- "info": true, --}}
          {{-- "autoWidth": false --}}
        {{-- }); --}}
      {{-- }); --}}
    </script>
@endsection
