@extends('admin/template')
@section('content')

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <section class="col-lg-4 connectedSortable">
                {{-- QUANTIDADE USUARIO --}}
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $data['usuariosTotal']['ativos'] + $data['usuariosTotal']['excluidos'] }}</h3>
                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
                <!-- GRAFICO USUARIO -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico de Usuários</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="chartUser" style="height:250px"></canvas>
                    </div>
                </div>
            </section>

            <section class="col-lg-4 connectedSortable">
                {{-- QUANTIDADE PRODUTOS --}}
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $data['produtosTotal']['ativos'] + $data['produtosTotal']['pendentes'] }}</h3>
                        <p>Produtos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
                <!-- GRAFICO PRODUTOS -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico de Produtos</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="chartProduct" style="height:250px"></canvas>
                    </div>
                </div>
            </section>

            <section class="col-lg-4 connectedSortable">
                {{-- QUANTIDADE MENSAGENS --}}
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $data['contatosTotal']['respondidos'] + $data['contatosTotal']['pendentes'] }}</h3>
                        <p>Mensagens</p>
                    </div>
                    <div class="icon">
                        <i class="ion fa-envelope-o ion-email"></i>
                    </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> --}}
                </div>
                <!-- GRAFICO MENSAGENS -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gráfico de Contatos</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="chartContact" style="height:250px"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <script src="../AdminLTE/plugins/chartjs/Chart.min.js"></script>
    <script>
        $(function(){
            var chartUser = $("#chartUser").get(0).getContext("2d");
            var chart1 = new Chart(chartUser);
            var PieData1 = [
                {
                    value: {{ $data['usuariosTotal']['ativos'] }},
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Ativos"
                },
                {
                    value: {{ $data['usuariosTotal']['excluidos'] }},
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "Excluidos"
                 }
            ];
            var pieOptions1 = {
                  segmentShowStroke: true,
                  segmentStrokeColor: "#fff",
                  segmentStrokeWidth: 2,
                  percentageInnerCutout: 50, // This is 0 for Pie charts
                  animationSteps: 100,
                  animationEasing: "easeOutBounce",
                  animateRotate: true,
                  animateScale: false,
                  responsive: true,
                  maintainAspectRatio: true,
                  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            chart1.Doughnut(PieData1, pieOptions1);

            var chartProduct = $("#chartProduct").get(0).getContext("2d");
            var chart2 = new Chart(chartProduct);
            var PieData2 = [
                {
                    value: {{ $data['produtosTotal']['ativos'] }},
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Ativos"
                },
                {
                    value: {{ $data['produtosTotal']['excluidos'] }},
                    color: "#f56954",
                    highlight: "#f56954",
                    label: "Excluídos"
                 },
                 {
                    value: {{ $data['produtosTotal']['pendentes'] }},
                    color: "#f39c12",
                    highlight: "#f39c12",
                    label: "Pendentes"
                  }
            ];
            var pieOptions2 = {
                  segmentShowStroke: true,
                  segmentStrokeColor: "#fff",
                  segmentStrokeWidth: 2,
                  percentageInnerCutout: 50, // This is 0 for Pie charts
                  animationSteps: 100,
                  animationEasing: "easeOutBounce",
                  animateRotate: true,
                  animateScale: false,
                  responsive: true,
                  maintainAspectRatio: true,
                  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            chart2.Doughnut(PieData2, pieOptions2);

            var chartContact = $("#chartContact").get(0).getContext("2d");
            var chart3 = new Chart(chartContact);
            var PieData3 = [
                {
                    value: {{ $data['contatosTotal']['respondidos'] }},
                    color: "#00a65a",
                    highlight: "#00a65a",
                    label: "Respondidos"
                },
                {
                    value: {{ $data['contatosTotal']['pendentes'] }},
                    color: "#f39c12",
                    highlight: "#f39c12",
                    label: "Pendentes"
                 }
            ];
            var pieOptions3 = {
                  segmentShowStroke: true,
                  segmentStrokeColor: "#fff",
                  segmentStrokeWidth: 2,
                  percentageInnerCutout: 50, // This is 0 for Pie charts
                  animationSteps: 100,
                  animationEasing: "easeOutBounce",
                  animateRotate: true,
                  animateScale: false,
                  responsive: true,
                  maintainAspectRatio: true,
                  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            };
            chart3.Doughnut(PieData3, pieOptions3);
        })
    </script>
@endsection
