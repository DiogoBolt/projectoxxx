<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>BackOffice | </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!--Token Ajax-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <!--<link rel="stylesheet" href="/assets/css/AdminLTE.min.css">-->
        <link rel="stylesheet" href="/assets/css/AdminLTE.css">
        <link rel="stylesheet" href="/assets/css/skins/skin-blue.min.css">
        <link rel="stylesheet" href="/assets/css/custom.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- jQuery 2.1.4 -->
        <script src="/assets/plugins/es6-promise/dist/es6-promise.auto.min.js"></script>
        <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="/assets/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/assets/plugins/sweetalert2/dist/sweetalert2.min.css">

        @if (Request::route()->getName() != "bonus.edit" && Request::route()->getName() != "bonus.create")
        <script>
            var baseURL = '{{url('/')}}';
            $.ajaxPrefilter( function( options, originalOptions, jqXHR ) {
                options.url = originalOptions.url.replace(/\/\s*$/, "");
                if (originalOptions.url && originalOptions.url.indexOf('/') === 0) {
                    console.log('Request', baseURL, options, originalOptions);
                    swal({
                        title: 'Problem URL!',
                        html: 'URL: ' + options.url + '<br>Don\'t start with ' + baseURL,
                    });
                }
            });
        </script>
        @endif
        <style>
            body {
                height: 100%;
                /*position: fixed;*/
                width: 100%;
            }
        </style>
        @yield('css')

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <!-- Main Header -->
            <header class="main-header">
                <!-- Logo -->
                <a href="/" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <h2>LOGO</h2>
                    <!-- logo for regular state and mobile devices -->
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-text"><div></div></div>
                    @yield('header')
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                @yield('sidebar')
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('contentheader')

                @include('layouts.messages')

                <!-- Main content -->
                <section class="content">
                    <!-- Page Content -->
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                @include('layouts.footer')
            </footer>

        </div><!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <script src="/assets/plugins/jQueryUI/jquery-ui.js"></script>
        <link rel="stylesheet" href="/assets/plugins/jQueryUI/jquery-ui.css">
        <!-- Bootstrap 3.3.5 -->
        <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/assets/js/app.js"></script>
        <!-- SlimScroll -->
        <script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/assets/plugins/fastclick/fastclick.min.js"></script>
        <!-- Custom JS -->
        <script src="/assets/js/custom.js"></script>

        @yield('scripts')

    </body>
</html>
