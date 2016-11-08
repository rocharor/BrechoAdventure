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

        <link rel="shortcut icon" href="/imagens/favicon.ico" type="image/x-icon" />

        <title>Brechó Adventure</title>
        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.css" />

		<link type="text/css" rel="stylesheet" href="/css/global.css" />
		<link type="text/css" rel="stylesheet" href="/css/topo.css" />
		<link type="text/css" rel="stylesheet" href="/css/rodape.css" />
    </head>
    <body>
        <div>
        	@include('topo')
        </div>

        <div class="container" style="border: solid 0px;">
            @yield('content')
        </div>

        <div>
        	@include('rodape')
        </div>

        <script src="/libs/jquery/dist/jquery.js"></script>
        <script src="/libs/bootstrap/dist/js/bootstrap.js"></script>
		<!-- <script src="/js/padrao.js"></script> -->
    </body>
</html>
