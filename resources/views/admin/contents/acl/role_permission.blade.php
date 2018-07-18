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
            <li class="active">Roles - Permissions</li>
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
                        <form action="{{ Route('admin.acl.update-role-permission') }}" method="post">
                            {{ csrf_field() }}

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
                                                        @if(in_array($value2->id, explode(',',$value->permissions)))
                                                            <input type="checkbox" class="minimal-red" name='ckecks[]' value="{{ $value->id }}-{{ $value2->id }}" checked>
                                                        @else
                                                            <input type="checkbox" class="minimal-red" name='ckecks[]' value="{{ $value->id }}-{{ $value2->id }}">
                                                        @endif
                                                        &nbsp;{{ $value2->name }}
                                                    </label>
                                                    <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <br>

                            {{-- <button  class="btn btn-success act-salvar"> Salvar </button> --}}
                            <button  type='submit' class="btn btn-success"> Salvar </button>
                        </form>
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

        // $('.act-salvar').on('click', function(){
        //     var checks = {};
        //
        //     $('input[type=checkbox]:checked').each(function(){
        //         role = $(this).attr('data-role');
        //         permission = $(this).val();
        //
        //         if (checks[role]) {
        //             checks[role].push(permission);
        //         }else{
        //             checks[role] = [
        //                 permission
        //             ]
        //         }
        //     })
        //
        //     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        //
        //     var url = '/admin/acl/role-permissions/update';
        //
        //     $.ajax({
        //            url: url,
        //            dataType: 'json',
        //            type: 'POST',
        //            data: {
        //                checks: checks
        //             },
        //            success: function(retorno){
        //            }
        //     });
        // });
    </script>
@endsection
