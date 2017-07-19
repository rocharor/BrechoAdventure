@extends('admin/template')
@section('content')

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="/AdminLTE/plugins/iCheck/all.css">

    <style media="screen">
        label{
            font-weight: normal;
            cursor: pointer;
        }
    </style>

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ Route('admin.user') }}"></i> Users</a></li>
            <li class="active">Roles - Permissions</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Editar Usuário <b>{{ $data['user']->name }}</b></h3>
                    </div>
                    <div class="box-body">
                        <form action='{{ Route('admin.user-update') }}' name='formPerfil' id='formPerfil'  method="POST">
                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{ $data['user']->id }}">

                            <table class="table table-striped" style="width: 800px;">
                                <tr>
                                    <td style="width: 200px;"><label>Nome: <span class='text-danger'>*</span></label> </td>
                                    <td><input type="text" name='nome' class="form-control" value="{{ $data['user']->name }}" required /></td>
                                </tr>
                                <tr>
                                    <td> <label>Email: <span class='text-danger'>*</span></label> </td>
                                    <td><input type="text" name='email' class="form-control" value="{{ $data['user']->email }}" required /></td>
                                </tr>
                                <tr>
                                    <td> <label>Data de nascimeto: <span class='text-danger'>*</span></label> </td>
                                    <td><input type="text" id='dt_nascimento' name='dt_nascimento' class="form-control" style="width: 150px;" value="{{ $data['user']->dt_nascimento }}" required /></td>
                                </tr>
                                <tr>
                                    <td><label>CEP: </label> </td>
                                    <td><input type="text" id='cep' name='cep' class="form-control" style="width: 150px;" value="{{ $data['user']->cep }}"/></td>
                                </tr>
                                <tr>
                                    <td><label>Endere&ccedil;o: </label> </td>
                                    <td><input type="text" name='endereco' class="form-control" value="{{ $data['user']->endereco }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>Numero: </label> </td>
                                    <td><input type="text" name='numero' class="form-control" style="width: 150px;" value="{{ $data['user']->numero }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>Complemento: </label> </td>
                                    <td><input type="text" name='complemento' class="form-control" value="{{ $data['user']->complemento }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>Bairro: </label> </td>
                                    <td><input type="text" name='bairro' class="form-control" value="{{ $data['user']->bairro }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>Cidade: </label> </td>
                                    <td><input type="text" name='cidade' class="form-control" value="{{ $data['user']->cidade }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>UF: </label> </td>
                                    <td>
                                        <select class="form-control" name='uf' style="width: 150px;">
                                            @foreach($data['estados'] as $sigla=>$desc)
                                                <option value="{{$sigla}}" @if( $data['user']->uf == $sigla) selected @endif>{{$desc}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label>Telefone Cel: </label> </td>
                                    <td><input type="text" id='telefone_cel' name='telefone_cel' class="form-control" style="width: 150px;" value="{{ $data['user']->telefone_cel }}" /></td>
                                </tr>
                                <tr>
                                    <td><label>Telefone Fixo: </label> </td>
                                    <td><input type="text" id='telefone_fixo' name='telefone_fixo' class="form-control" style="width: 150px;" value="{{ $data['user']->telefone_fixo }}" /></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><button type="submit" class="btn btn-primary">Salvar</button></td>
                                </tr>
                            </table>
                        </form>

                        @can('admin-master')
                            <div class="permissoes">
                                <h1>Roles</h1>
                                <form action="{{ Route('admin.master.acl-update-role-user') }}" method="post">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="user_id" value="{{ $data['user']->id }}">
                                    @foreach ($data['roles'] as $role)
                                        @if (in_array($role->id, $data['role-user']))
                                            <p><label><input type="checkbox" class="minimal-red" name='ckecks[]' value="{{ $role->id }}" checked>&nbsp;{{ $role->name }}</label></p>
                                        @else
                                            <p><label><input type="checkbox" class="minimal-red" name='ckecks[]' value="{{ $role->id }}">&nbsp;{{ $role->name }}</label></p>
                                        @endif
                                    @endforeach

                                    <button type="submit" class='btn btn-primary' name="button">Salvar Role</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- iCheck 1.0.1 -->
    <script src="/AdminLTE/plugins/iCheck/icheck.min.js"></script>
    <script src="/node_modules/vanilla-masker/build/vanilla-masker.min.js"></script>
    <script type="text/javascript">
        VMasker(document.getElementById("dt_nascimento")).maskPattern('99/99/9999');
        VMasker(document.getElementById("cep")).maskPattern('99999-999');
        VMasker(document.getElementById("telefone_fixo")).maskPattern('(99) 9999-9999');
        VMasker(document.getElementById("telefone_cel")).maskPattern('(99) 99999-9999');
    </script>

    <script>
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red.minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red'
        });
    </script>
@endsection
