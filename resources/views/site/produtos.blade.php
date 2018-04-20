@extends('template')
@section('content')

    <!--BREADCRUMB-->
    @include('complements/breadCrumb')

    <div class="row" >

        <aside class="col-lg-3 col-md-3 col-sm-4 hidden-xs">
            @include('complements/filtroLateral')
        </aside>
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 hide" id='el-produtos'>
            <div class="row">
                @foreach($produtos as $produto)
                    @include('complements/catalogProducts')
                @endforeach

                <!--PAGINAÇÃO-->
                <br style="clear:both">
                <div align='center'>
                    @include('complements/paginacao')
                </div>

                <!--Modal mensagem-->
                <div class="modal fade" id='modal-mensagem'>
                    @include('complements/modalMensagem')
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function(){
            appVueFiltro.buscaDadosFiltro();
        })
    </script>
@endsection
