<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id='token' content="{{ csrf_token() }}" value="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/css/site.min.css" />
</head>
<body>
    <div id="app">
        <div>
            @include('topo')
        </div>

        @yield('content')

        <div>
        	@include('rodape')
        </div>
    </div>

</body>
</html>
