@extends('admin/template')
@section('content')

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <section class="content-header">
        <h1>
            Dashboard
            <small>Painel de controle</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ Route('admin.home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Visualização de mensagem</li>
        </ol>
    </section>

    <section class="content">
    	<div class="row" >
    		<div class="col-xs-12 col-sm-10">
    			<table class='table table-hover'>
    				<tr>
    					<td><b>Nome:</b></td>
    					<td>{{ $data['contato']->nome }} </td>
    				</tr>
    				<tr>
    					<td><b>E-mail:</b></td>
    					<td>{{ $data['contato']->email }} </td>
    				</tr>
    				<tr>
    					<td><b>Tipo:</b></td>
    					<td>{{ $data['contato']->tipo }} </td>
    				</tr>
    				<tr>
    					<td><b>Mensagem:</b></td>
    					<td>{{ $data['contato']->mensagem }} </td>
    				</tr>
    			</table>

                <br>

                <div class="col-md-9">
                    <div class="box box-primary">
                        <form action="{{ Route('admin.pendente.contact-resposta') }}" method="post">
                            {{ csrf_field() }}

                            <input type='hidden' name='nome' value='{{ $data['contato']->nome }}'>
                            <input type='hidden' name='mensagem' value='{{ $data['contato']->mensagem }}'>
                            <input type='hidden' name='contato_id' value='{{ $data['contato']->id }}'>

                            <div class="box-header with-border">
                                <h3 class="box-title">Responder mensagem</h3>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <input type='text' class="form-control" name='email' placeholder="To:" value='{{ $data['contato']->email }}'>
                                </div>
                                <div class="form-group">
                                    <input type='text' class="form-control" name='assunto' placeholder="Subject:" value='Resposta Brecho Adventure - {{ $data['contato']->tipo }}'>
                                </div>
                                <div class="form-group">
                                    <textarea id="compose-textarea" name='resposta' class="form-control" style="height: 300px"></textarea>
                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>





    		</div>
    	</div>
    </section>

    <!-- Bootstrap WYSIHTML5 -->
    <script src="/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

    <script>
        $(function () {
          $("#compose-textarea").wysihtml5();
        });
    </script>
@endsection
