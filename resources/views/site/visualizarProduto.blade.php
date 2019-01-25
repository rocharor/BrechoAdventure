@extends('template')
@section('content')
    <div id='el-view-products' class='hide'>

        {{-- BREADCRUMB --}}
        <div>
            <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
        </div>

        <h1>{{ $produto->titulo }}</h1>

        <small style="color:#bbb"><i>Inserido em: {{ $produto->inserido }}</i></small>

        <br><br>

        <div class="row">
            <div class="col-xs-12 col-sm-10">
                <div>
                    {{-- Component Product Zoom  --}}
                    <product-zoom :images="{{ $produto->imagens_json }}" />
                </div>

                <h3>Preço: <span style='color:#a00;'>R${{ $produto->valor }}</span></h3>

                <p>{{ $produto->descricao }}</p>

                <p><b>Categoria:</b> {{ $produto->categoria->categoria }}</p>

                <p><b>Estado:</b> {{ $produto->estado }}</p>

                <hr style="border-color: #ddd;">

                <div>
                <modal-contact :auth="{{ Auth::check() ? 1 : 0 }}" :product-id="{{ $produto->id }}" :icon="false"/>
                </div>


                {{-- <h3>Dados do vendedor</h3> --}}

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
            </div>
        </div>
    </div>
@endsection
