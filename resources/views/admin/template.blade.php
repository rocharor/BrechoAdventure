<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Brecho Adventure | Dashboard</title>

        <link rel="shortcut icon" href="/imagens/favicon.ico" type="image/x-icon" />

        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="/AdminLTE/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/AdminLTE/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/AdminLTE/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="/AdminLTE/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="/AdminLTE/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="/AdminLTE/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="/AdminLTE/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- jQuery 2.2.0 -->
        <script src="/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js"></script>

        <script src="/js/global.js"></script>
        
        <link rel="stylesheet" href="/libs/animate.css/animate.css" />
        <script src="/libs/bootstrap-notify/bootstrap-notify.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        @if (session('sucesso')) <script>alertaPagina('{{ session('sucesso') }}', 'success');</script> @endif
	    @if (session('erro')) <script>alertaPagina('{{ session('erro') }}', 'danger');</script> @endif

        <div class="wrapper">
        	@include('admin/top')

        	@include('admin/menuLateral')

            <div class="content-wrapper">
                @yield('content')
            </div>


        	@include('admin/footer')
        </div>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="/AdminLTE/plugins/morris/morris.min.js"></script>
        <!-- Sparkline -->
        <script src="/AdminLTE/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="/AdminLTE/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="/AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="/AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/AdminLTE/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="/AdminLTE/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/AdminLTE/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/AdminLTE/dist/js/demo.js"></script>
    </body>
</html>
