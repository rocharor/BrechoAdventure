@extends('template')
@section('content')
    <div id='el-product' class='hide'>

        {{-- BREADCRUMB --}}
        <div>
            <breadcrumb :data-breadcrumb="{{ $breadCrumb }}"/>
        </div>

        <div class="row" >
            <aside class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
                {{-- @include('complements/filtroLateral') --}}
            </aside>

            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <div class="row">
                    @foreach($produtos['itens'] as $produto)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <product :data-product="{{ $produto->toJson() }}" :data-user="{{ $produtos['user'] }}" :auth="{{ Auth::check() ? 1 : 0 }}"/>
                        </div>
                    @endforeach

                    <br style="clear:both">

                    {{-- PAGINAÇÃO --}}
                    <div align='center'>
                        @include('complements/paginacao')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- < script>
        $(function(){
            appVueFiltro.buscaDadosFiltro();
        })
    < /script> --}}
@endsection
