@extends('template')

@section('content')

	<!--BREADCRUMB-->
    {{-- @include('complements/breadCrumb') --}}
    <div id='breadcrumb'>
        <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
    </div>

    <h1 class="text-danger">PERFIL</h1>

    <div id='el-form'>

        {{-- FOTO PERFIL --}}
        <div align="left">
            @include('complements/uploadImagem')
        </div>

        <br>

        {{-- FORMULARIO PERFIL --}}
        <div class="formulario">
            @include('complements/exibeErro')

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form action='{{ Route('minha-conta.update-perfil') }}' name='formPerfil' id='formPerfil'  method="POST">
                {{ csrf_field() }}

                <table class="table table-striped">
                    <tr>
                        <td style="width: 200px;"><label>Nome: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" name='nome' class="form-control" value="{{ Auth::user()->name }}" required /></td>
                    </tr>
                    <tr>
                        <td> <label>Email: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" name='email' class="form-control" value="{{ Auth::user()->email }}" disabled /></td>
                    </tr>
                    <tr>
                        <td> <label>Data de nascimeto: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='dt_nascimento' name='dt_nascimento' class="form-control" style="width: 150px;" value="{{ Auth::user()->dt_nascimento }}" required /></td>
                    </tr>
                    <tr>
                        <td><label>CEP: </label> </td>
                        <td><input type="text" id='cep' name='cep' class="form-control" style="width: 150px;" value="{{ Auth::user()->cep }}" onblur="buscaCEP(this.value)"/></td>
                    </tr>
                    <tr>
                        <td><label>Endere&ccedil;o: </label> </td>
                        <td><input type="text" name='endereco' class="form-control" value="{{ Auth::user()->endereco }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Numero: </label> </td>
                        <td><input type="text" name='numero' class="form-control" style="width: 150px;" value="{{ Auth::user()->numero }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Complemento: </label> </td>
                        <td><input type="text" name='complemento' class="form-control" value="{{ Auth::user()->complemento }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Bairro: </label> </td>
                        <td><input type="text" name='bairro' class="form-control" value="{{ Auth::user()->bairro }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Cidade: </label> </td>
                        <td><input type="text" name='cidade' class="form-control" value="{{ Auth::user()->cidade }}" /></td>
                    </tr>
                    <tr>
                        <td><label>UF: </label> </td>
                        <td>
                            <select class="form-control" name='uf' style="width: 150px;">
                                @foreach($estados as $sigla=>$desc)
                                    <option value="{{$sigla}}" @if( Auth::user()->uf == $sigla) selected @endif>{{$desc}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Telefone Cel: </label> </td>
                        <td><input type="text" id='telefone_cel' name='telefone_cel' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_cel }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Telefone Fixo: </label> </td>
                        <td><input type="text" id='telefone_fixo' name='telefone_fixo' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_fixo }}" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><button type="submit" class="btn btn-success">Salvar</button></td>
                    </tr>
                </table>
            </form>

            <hr>

            <button type="button" class="btn btn-primary" :class='{hide: btnForm == false}' @click.prevent='openAlterPassword()'>Redefinir de senha</button>

            <div :class='{hide: divAlterPassword == false}' >
                <form class="form-horizontal" role="form" method="POST" action="{{ Route('minha-conta.update-password') }}">
                    {{ csrf_field() }}
					<table>
						<tr>
							<td><label>Senha Atual: </label></td>
							<td><input type='password' name='old_password' class="form-control"/></td>
						</tr>
						<tr>
							<td><label>Nova Senha: </label></td>
							<td><input type='password' name='new_password' class="form-control"/></td>
						</tr>
						<tr>
							<td><label>Confirme a Senha: &nbsp;</label></td>
							<td><input type='password' name='confirm_password' class="form-control"/></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td colspan='2' align='center'>
								<button type="submit" class="btn btn-success">Salvar</button>
								<button type="submit" class="btn btn-danger" @click.prevent='closeAlterPassword()'>Cancelar</button>
							</td>
						</tr>
					</table>
                </form>
            </div>
        </div>
    </div>
@endsection
