@extends('admin/template')
@section('content')

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/AdminLTE/plugins/iCheck/all.css">

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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Roles</h3>
                    </div>
                    <div class="box-body">
                        <table id="table-roles" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Persmissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['roles'] as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            @foreach($data['permissions'] as $value2)
                                                <label>
                                                  <input type="checkbox" class="minimal-red" value="{{ $value2->id }}">
                                                  {{ $value2->name }}
                                                </label>
                                                {{-- <input type="checkbox" name="chk_permission" value="{{ $value2->id }}"> &nbsp;<label>{{ $value2->name }}</label><br> --}}
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <br>

                        <button class="btn btn-success"> Salvar </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- iCheck 1.0.1 -->
    <script src="/AdminLTE/plugins/iCheck/icheck.min.js"></script>

    <script>
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red.minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red'
        });
    </script>
@endsection
