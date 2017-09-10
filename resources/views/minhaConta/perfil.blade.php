@extends('template')
@section('content')

    <!--BREADCRUMB-->
	@include('breadCrumb')

    <link rel="stylesheet" href="/node_modules/jquery-jcrop/css/jquery.Jcrop.min.css" type="text/css" />
    <link rel="stylesheet" href="/css/minhaConta.css" type="text/css"/>

    <div>
        {{-- FOTO PERFIL --}}
        <div align="left">
            @include('uploadImagem')
        </div>
        <br>
        {{-- FORMULARIO PERFIL --}}
        <div class="form_perfil">
            @include('exibeErro')
            <form action='{{ Route('minha-conta.update-perfil') }}' name='formPerfil' id='formPerfil'  method="POST">
                {{ csrf_field() }}

                <table class="table table-striped" style="width: 800px;">
                    <tr>
                        <td style="width: 200px;"><label>Nome: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" name='nome' class="form-control" value="{{ Auth::user()->name }}" required /></td>
                    </tr>
                    <tr>
                        <td> <label>Email: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" name='email' class="form-control" value="{{ Auth::user()->email }}" required /></td>
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
                        <td colspan="2" align="center"><button type="submit" class="btn btn-primary">Salvar</button></td>
                    </tr>
                </table>
            </form>

            {{-- <form action='/minha-conta/perfil/update' name='formPerfil' id='formPerfil'  method="POST">
                {{ csrf_field() }}
                <table class="table table-striped">
                    <tr>
                        <td><label>Nome: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='nome_upd' name='nome' class="form-control" style="width: 300px;" value="{{ Auth::user()->name }}" /></td>
                    </tr>
                    <tr>
                        <td> <label>Email: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='email_upd' name='email' class="form-control" style="width: 300px;" value="{{ Auth::user()->email }}" /></td>
                    </tr>
                    <tr>
                        <td> <label>Data de nascimeto: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='dt_nascimento_upd' name='dt_nascimento' class="form-control" style="width: 100px;" value="{{ Auth::user()->dt_nascimento }}" /></td>
                    </tr>
                    <tr>
                        <td><label>CEP: </label> </td>
                        <td><input type="text" id='cep_upd' name='cep' class="form-control" style="width: 100px;" value="{{ Auth::user()->cep }}" onblur="buscaCEP(this.value)"/></td>
                    </tr>
                    <tr>
                        <td><label>Endere&ccedil;o: </label> </td>
                        <td><input type="text" id='endereco_upd' name='endereco' class="form-control" style="width: 300px;" value="{{ Auth::user()->endereco }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Numero: </label> </td>
                        <td><input type="text" id='numero_upd' name='numero' class="form-control" style="width: 100px;" value="{{ Auth::user()->numero }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Complemento: </label> </td>
                        <td><input type="text" id='complemento_upd' name='complemento' class="form-control" style="width: 300px;" value="{{ Auth::user()->complemento }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Bairro: </label> </td>
                        <td><input type="text" id='bairro_upd' name='bairro' class="form-control" style="width: 300px;" value="{{ Auth::user()->bairro }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Cidade: </label> </td>
                        <td><input type="text" id='cidade_upd' name='cidade' class="form-control" style="width: 300px;" value="{{ Auth::user()->cidade }}" /></td>
                    </tr>
                    <tr>
                        <td><label>UF: </label> </td>
                        <td>
                            <select class="form-control" id='uf_upd' name='uf' style="width: 100px;">
                                @foreach($estados as $sigla=>$desc)
                                    <option value="{{$sigla}}" @if( Auth::user()->uf == $sigla) selected @endif>{{$desc}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Telefone Fixo: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='tel_upd' name='telefone_fixo' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_fixo }}" /></td>
                    </tr>
                    <tr>
                        <td><label>Telefone Cel: <span class='text-danger'>*</span></label> </td>
                        <td><input type="text" id='cel_upd' name='telefone_cel' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_cel }}" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><button type="submit" class="btn btn-primary act-update">Salvar</button></td>
                    </tr>
                </table>
            </form> --}}
        </div>
    </div>

    <script type="text/javascript" src="/node_modules/jquery-jcrop/js/jquery.Jcrop.min.js"></script>
    <script type="text/javascript" src="/js/site/perfil.js"></script>

@endsection
