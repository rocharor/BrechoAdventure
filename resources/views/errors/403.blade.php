@extends('template')
@section('content')
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <style>
        .box {
            text-align: center;
            font-family: 'Lato', sans-serif;
            width: 100%;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .title {
            font-size: 72px;
            margin-bottom: 40px;
            color:red;
        }
    </style>

    <ol class="breadcrumb">
      <li><a href="/"><span class='glyphicon glyphicon-home'> Home</span></a></li>
      <li class="active">N&atilde;o autorizado</li>
    </ol>

    <div class="box">
        <div class="content">
            <div class="title"><b>NÃO AUTORIZADO.</b></div>
        </div>
    </div>

    <br />
    
    <a href="javascript:window.history.go(-1)" class='btn btn-primary'><span class="glyphicon glyphicon-menu-left"> Voltar</a>
@endsection
