@extends('template')
@section('content')
    <ol class="breadcrumb">
      <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
      <li class="active">Perfil</li>
    </ol>

<link type="text/css" rel="stylesheet" href="/css/minhaConta.css" />

<h1 class="text-danger">PERFIL</h1>
<div>    
    <div align="left">
        <form action='/minha-conta/perfil/updateFoto' name='formFotoPerfil' method='POST' enctype="multipart/form-data">
            {{ csrf_field() }}

            <img src="/imagens/cadastro/{{ Auth::user()->nome_imagem }}" alt="brechoAdventure" class="img_perfil" /><br>
            <small><a class="act-alter-foto">Alterar foto de perfil</a></small>
            <br>
            {{-- <button class="btn btn-success hide act-enviar-imagem">Salvar foto</button>&nbsp;&nbsp;<b><small class='nm_imagem'></small></b> --}}
            <button type='submit' id='btnEnviaFoto' class="btn btn-success hide">Salvar foto</button>&nbsp;&nbsp;
            <b><small class='nm_imagem'></small></b>

            <input type="file" class="hide" id='foto_upd' name='imagemPerfil' onchange="altera_imagem()">
        </form>
    </div>
    <br>

    <table class="table table-striped">
        <tr>
            <td><label>Nome: <span class='text-danger'>*</span></label> </td>
            <td><input type="text" id='nome_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->name }}" /></td>
        </tr>
        <tr>
            <td><label>Apelido: </label> </td>
            <td><input type="text" id='apelido_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->apelido }}" /></td>
        </tr>
        <tr>
            <td> <label>Email: <span class='text-danger'>*</span></label> </td>
            <td><input type="text" id='email_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->email }}" /></td>
        </tr>
        <tr>
            <td> <label>Data de nascimeto: <span class='text-danger'>*</span></label> </td>
            <td><input type="text" id='dt_nascimento_upd' class="form-control" style="width: 100px;" value="{{ Auth::user()->dt_nascimento }}" /></td>
        </tr>
        <tr>
            <td><label>CEP: </label> </td>
            <td><input type="text" id='cep_upd' class="form-control" style="width: 100px;" value="{{ Auth::user()->cep }}" onblur="buscaCEP(this.value)"/></td>
        </tr>
        <tr>
            <td><label>Endere&ccedil;o: </label> </td>
            <td><input type="text" id='endereco_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->endereco }}" /></td>
        </tr>
        <tr>
            <td><label>Numero: </label> </td>
            <td><input type="text" id='numero_upd' class="form-control" style="width: 100px;" value="{{ Auth::user()->numero }}" /></td>
        </tr>
        <tr>
            <td><label>Complemento: </label> </td>
            <td><input type="text" id='complemento_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->complemento }}" /></td>
        </tr>
        <tr>
            <td><label>Bairro: </label> </td>
            <td><input type="text" id='bairro_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->bairro }}" /></td>
        </tr>
        <tr>
            <td><label>Cidade: </label> </td>
            <td><input type="text" id='cidade_upd' class="form-control" style="width: 300px;" value="{{ Auth::user()->cidade }}" /></td>
        </tr>
        <tr>
            <td><label>UF: </label> </td>
            <td>
                <select class="form-control" id='uf_upd' style="width: 100px;">
                    @foreach($estados as $sigla=>$desc)
                        <option value="{{$sigla}}">{{$desc}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Telefone Fixo: <span class='text-danger'>*</span></label> </td>
            <td><input type="text" id='tel_upd' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_fixo }}" /></td>
        </tr>
        <tr>
            <td><label>Telefone Cel: <span class='text-danger'>*</span></label> </td>
            <td><input type="text" id='cel_upd' class="form-control" style="width: 150px;" value="{{ Auth::user()->telefone_cel }}" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><button type="submit" class="btn btn-primary act-update">Salvar</button></td>
        </tr>
    </table>
</div>

<script type="text/javascript" src="/js/minhaConta/perfil.js"></script>
@endsection
