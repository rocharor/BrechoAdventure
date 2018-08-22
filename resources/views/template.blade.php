<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
		<meta name="format-detection" content="telephone=no" />
		<meta name="author" content="Ricardo Rocha"/>
        <meta name="copyright" content="Ricardo Rocha"/>
        <meta name="e-mail" content="rocharor@gmail.com"/>
        <meta name="keywords" content="Brecho Adventure"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link rel="shortcut icon" href="/imagens/favicon.ico" type="image/x-icon" />

        <title>{{ config('app.name', 'Brechó Adventure') }}</title>

        <!--CSS-->
		<link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
		<main class='hide' id='appMain'>
			<header>
	        	@include('header')
	        </header>

	        <section class="container">
	            @yield('content')
	        </section>

	        <footer>
	        	@include('footer')
	        </footer>
		</main>

		<script src="/js/app.js"></script>

		@if (session('sucesso')) <script>alertaPagina('{{ session('sucesso') }}', 'success');</script> @endif
	    @if (session('erro')) <script>alertaPagina('{{ session('erro') }}', 'danger');</script> @endif

    </body>
</html>
