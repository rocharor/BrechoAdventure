@extends('template')

@section('content')

    <div id='el-my-products' class='hide'>

        <!--BREADCRUMB-->
        <div id='breadcrumb'>
            <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
        </div>

        <div class="row" >
            @if (count($meusProdutos) == 0)
                <div class="well" align="center"><b><i>Voc&ecirc; n&atilde;o possui produtos cadastrados</i></b></div>
            @else
                @foreach ($meusProdutos as $produto)
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 div-meus-produtos" align="center">
                        <my-product :product="{{ $produto->toJson() }}" />
                    </div>
                @endforeach

                <br style="clear:both">

                <!--PAGINAÇÃO-->
                <div align='center'>
                    <pagination pg="{{ $pg }}" link="{{ $link }}" number-pages="{{ $numberPages }}" />
                </div>
            @endif
        </div>
    </div>
@endsection
