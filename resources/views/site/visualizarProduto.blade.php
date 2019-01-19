@extends('template')
@section('content')
    <div id='el-view-products' class='hide'>

        <link type="text/css" rel="stylesheet" href="/plugins/xzoom/dist/xzoom.css" />

        {{-- BREADCRUMB --}}
        <div>
            <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
        </div>

        <h1>{{ $produto->titulo }}</h1>

        <small style="color:#bbb"><i>Inserido em: {{ $produto->inserido }}</i></small>

        <br><br>

        <div class="row">
            <div class="col-xs-12 col-sm-10">

                <div class="row">
                    <div class="col-md-5">
                        {{-- Component Product Zoom  --}}
                        <product-zoom :images="{{ $produto->imagens_json }}" />
                    </div>
                </div>

                <h3>Preço: <span style='color:#a00;'>R${{ $produto->valor }}</span></h3>

                <p>{{ $produto->descricao }}</p>



                <p><b>Categoria:</b> {{ $produto->categoria->categoria }}</p>

                <p><b>Estado:</b> {{ $produto->estado }}</p>

                <h3>Dados do vendedor</h3>

                {{-- <table class='table table-striped '>
                    <tr>
                        <td><b>Nome:</b></td>
                        <td>{{ $produto->user->name }} </td>
                    </tr>
                    <tr>
                        <td><b>E-mail:</b></td>
                        <td>{{ $produto->user->email }} </td>
                    </tr>
                    <tr>
                        <td><b>Telefone:</b></td>
                        <td>{{ $produto->user->telefone_fixo }} </td>
                    </tr>
                    <tr>
                        <td><b>Celular:</b></td>
                        <td>{{ $produto->user->telefone_cel }} </td>
                    </tr>
                </table> --}}

                {{-- <div class="el-produtos">
                    @if(Auth::check() == 0)
                        <button class='btn btn-info' title='Necessário estar logado' disabled><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
                    @elseif(Auth::user()->id == $produto->user->id)
                        <button class='btn btn-info' title='Este produto é seu' disabled><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
                    @else
                        <button class='btn btn-info' @click.prevent="openContact({{ $produto->id }})"><span class="glyphicon glyphicon-envelope"></span> Enviar mensagem</button>
                    @endif

                    <div class="modal fade" id='modal-mensagem'>
                        @include('complements/modalMensagem')
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
@endsection
