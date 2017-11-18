<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Disease Reporting</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Ionicons -->
{{--<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">--}}
<!-- jvectormap -->
{{--<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">--}}
<!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>DR</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Disease Reporting</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    {{--<li class="dropdown notifications-menu">--}}
                        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                            {{--<i class="fa fa-bell-o"></i>--}}
                            {{--<span class="label label-warning">2</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu">--}}
                            {{--<li class="header">You have 2 notifications</li>--}}
                            {{--<li>--}}
                                {{--<!-- inner menu: contains the actual data -->--}}
                                {{--<ul class="menu">--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-users text-aqua"></i> notification 1--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="#">--}}
                                            {{--<i class="fa fa-warning text-yellow"></i> notification 2--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li class="footer"><a href="#">View all</a></li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    <!-- Tasks: style can be found in dropdown.less -->

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">Shreyam Adhiakari</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    Shreyam Adhiakari - Web Developer
                                </p>
                            </li>
                            <!-- Menu Body -->
                           <li class="user-footer">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Shreyam Adhiakari</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li class="{{ Request::route()->getName() == 'admin.home' ? 'active': '' }}">
                    <a href="{{route('admin.home')}}"><i class="fa fa-home"></i>
                        Home
                    </a>
                </li>
            </ul>
        </section>
    </aside>


    @yield('content')


    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">SickLab</a>.</strong> All rights
        reserved.
    </footer>


</div>
<!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('js/adminlte.js')}}"></script>
<!-- Sparkline -->
{{--<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
<!-- jvectormap  -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- SlimScroll -->
{{--<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>--}}
<!-- ChartJS -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="js/pages/dashboard2.js"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="js/demo.js"></script>--}}
</body>
</html>
