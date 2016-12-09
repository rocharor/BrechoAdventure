<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" /> -->
		<meta name="format-detection" content="telephone=no" />
		<meta name="author" content="Ricardo Rocha"/>
        <meta name="copyright" content="Ricardo Rocha"/>
        <meta name="e-mail" content="rocharor@gmail.com"/>
        <meta name="keywords" content="Brecho Adventure"/>
		<meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="shortcut icon" href="/imagens/favicon.ico" type="image/x-icon" />

        <title>Brechó Adventure</title>
        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.css" />
        <link rel="stylesheet" href="/libs/animate.css/animate.css" />

		<link type="text/css" rel="stylesheet" href="/css/global.css" />
		<link type="text/css" rel="stylesheet" href="/css/topo.css" />
		<link type="text/css" rel="stylesheet" href="/css/rodape.css" />

		<script src="/libs/jquery/dist/jquery.js"></script>
        <script src="/libs/bootstrap/dist/js/bootstrap.js"></script>
		<script src="/libs/vanilla-masker-master/vanilla-masker.min.js"></script>
		<script src="/libs/bootstrap-notify/bootstrap-notify.js"></script>
		{{-- <script src="/libs/notify/notify.js"></script> --}}
		<script src="/js/global.js"></script>
    </head>
    <body>
		@if (session('sucesso')) <script>alertaPagina('{{ session('sucesso') }}', 'success');</script> @endif
	    @if (session('erro')) <script>alertaPagina('{{ session('erro') }}', 'danger');</script> @endif

        <div>
        	@include('topo')
        </div>

        <div class="container">
            @yield('content')
        </div>

		<br /><br />

        <div>
        	@include('rodape')
        </div>
    </body>
</html>
