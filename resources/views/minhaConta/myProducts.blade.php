@extends('template')
@section('content')

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
                @include('complements/paginacao')
            </div>
        @endif
    </div>
@endsection
