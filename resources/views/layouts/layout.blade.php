<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
     {{ isset($title) ? $title.' | '.config('fadmin.base.project_name') : config('fadmin.base.project_name') }}
    </title>

    @yield('before_styles')
    @stack('before_styles')


    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/fadmin/css/base.css?v=2">
    <link rel="stylesheet" href="/fadmin/css/bold.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" --}}

    {{-- <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="/fadmin/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fadmin/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/fadmin/ionicons/dist/css/ionicons.min.css">

    <link rel="stylesheet" href="/fadmin/admin-lte/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/fadmin/admin-lte/dist/css/skins/_all-skins.css">

    <link rel="stylesheet" href="/fadmin/admin-lte/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="/fadmin/pnotify/pnotify.custom.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="/fadmin/css/base.css?v=2">
    <link rel="stylesheet" href="/fadmin/css/bold.css">





    @yield('after_styles')
    @stack('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition {{ config('fadmin.base.skin') }} sidebar-mini">
    <script type="text/javascript">
        /* Recover sidebar state */
        (function () {
            if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
                var body = document.getElementsByTagName('body')[0];
                body.className = body.className + ' sidebar-collapse';
            }
        })();
    </script>
    <!-- Site wrapper -->
    <div id="app" class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ route('fadmin.dashboard') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">{!! config('fadmin.base.logo_mini') !!}</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! config('fadmin.base.logo_lg') !!}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">{{ trans('base.toggle_navigation') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          @include('layouts.include.menu')
        </nav>
      </header>

      <!-- =============================================== -->

      @include('layouts.include.sidebar')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        @if (config('fadmin.base.handcrafted_by'))
            <div class="pull-right hidden-xs">
              {{ trans('base.handcrafted_by') }} <a target="_blank" href="{{ config('fadmin.base.developer_link') }}">{{ config('fadmin.base.developer_name') }}</a>.
            </div>
        @endif
            {{ trans('base.powered_by') }} <a target="_blank" href="{{ config('fadmin.base.developer_link') }}">{{ config('fadmin.base.developer_name') }}</a>
      </footer>
    </div>
    <!-- ./wrapper -->

    @yield('before_scripts')
    @stack('before_scripts')


    <script src="/fadmin/jquery/dist/jquery.min.js"></script>
    <script src="/fadmin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/fadmin/admin-lte/plugins/pace/pace.min.js"></script>

    <script src="/fadmin/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/fadmin/admin-lte/dist/js/adminlte.min.js"></script>


    <!-- page script -->
    <script type="text/javascript">
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
          event.preventDefault();
          if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '');
          } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1');
          }
        });
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function() { Pace.restart(); });
        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        // Set active state on menu element
        var current_url = "{{ Request::fullUrl() }}";
        var full_url = current_url+location.search;
        var $navLinks = $("ul.sidebar-menu li a");
        // First look for an exact match including the search string
        var $curentPageLink = $navLinks.filter(
            function() { return $(this).attr('href') === full_url; }
        );
        // If not found, look for the link that starts with the url
        if(!$curentPageLink.length > 0){
            $curentPageLink = $navLinks.filter(
                function() { return $(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')); }
            );
        }
        $curentPageLink.parents('li').addClass('active');
        {{-- Enable deep link to tab --}}
        var activeTab = $('[href="' + location.hash.replace("#", "#tab_") + '"]');
        location.hash && activeTab && activeTab.tab('show');
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            location.hash = e.target.hash.replace("#tab_", "#");
        });
    </script>

    @include('layouts.include.alerts')

    @yield('after_scripts')
    @stack('after_scripts')

    @if (env('APP_DEBUG'))
        @include('sudosu::user-selector')
    @endif
    <!-- JavaScripts -->
    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
</body>
</html>
