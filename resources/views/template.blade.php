<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		  (adsbygoogle = window.adsbygoogle || []).push({
		    google_ad_client: "ca-pub-1399867146563891",
		    enable_page_level_ads: true
		  });
		</script>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		{{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
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

		{{-- <link type="text/css" rel="stylesheet" href="/css/global.css" /> --}}
		<link type="text/css" rel="stylesheet" href="/css/topo.css" />
		<link type="text/css" rel="stylesheet" href="/css/rodape.css" />

		<script src="/libs/jquery/dist/jquery.js"></script>
        <script src="/libs/bootstrap/dist/js/bootstrap.js"></script>
		<script src="/libs/vanilla-masker-master/vanilla-masker.min.js"></script>
		<script src="/libs/bootstrap-notify/bootstrap-notify.js"></script>
		<script src="/libs/vue2/dist/vue.min.js"></script>
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

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-90475591-1', 'auto');
			ga('send', 'pageview');
		</script>
    </body>
</html>
