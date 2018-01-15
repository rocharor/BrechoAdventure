@extends('admin/template')
@section('content')

    <link rel="stylesheet" href="/AdminLTE/plugins/datatables/dataTables.bootstrap.css">

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Roles - Permissions</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Usuários</h3>
                    </div>
                    <div class="box-body">
                        <table id="table-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Usuário</th>
                                    <th>E-mail</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['users'] as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td style="width:100px">
                                            <a href='{{ Route('admin.usuario.user-edit', $value->id) }}' class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>
                                            <a href='{{ Route('admin.usuario.user-delete', $value->id) }}' class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>

                        <button  type='submit' class="btn btn-success"> Salvar </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>

    <script>
        $(function () {
            $('#table-user').DataTable({
                // "paging": true,
                // "lengthChange": false,
                // "searching": true,
                // "ordering": true,
                // "info": false,
                // "autoWidth": false
            });
        });
    </script>
@endsection
