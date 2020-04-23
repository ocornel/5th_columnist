<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | Inatrend</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <meta name="description" content="@yield('description')">
    <meta property="og:url" content="https://inatrend.mcornel.com">
    <meta property="og:type" content="blog">
    <meta property="og:title" content="@yield('title') | Inatrend">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@o_cornel">
    <meta name="twitter:creator" content="@o_cornel">
    <meta name="twitter:title" content="@yield('title')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="{{ asset('img/logo.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}" sizes="16x16">
    <link rel="manifest" href="{{ asset('docs/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('img/logo.png') }}" color="#38c8dd">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
      <link rel="stylesheet" href="{{ asset('css/vendor.min.css')}}">
      <link rel="stylesheet" href="{{ asset('css/elephant.min.css')}}">
      <link rel="stylesheet" href="{{ asset('css/application.min.css')}}">
      <link rel="stylesheet" href="{{ asset('css/demo.min.css')}}">

      <link href="{{asset('packages/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
      <link href="{{asset('packages/datatables.min.css')}}" rel="stylesheet">
      @yield('additional_styles')
      <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
  </head>
  <body class="layout layout-header-fixed">
    <div class="layout-header">
        @include('layouts.parts.topnav')
    </div>
    <div class="layout-main">
        @include('layouts.parts.sidenav')
      <div class="layout-content">
        <div class="layout-content-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="search_results" class="hidden search-results"></div>
                </div>
            </div>
            <div class="title-bar">
                <h1 class="title-bar-title">
                    <span class="d-ib">@yield('title')</span>
                    <div class="pull-right">
                        @yield('page_actions')
                    </div>
                </h1>
            </div>
            @yield('content')
        </div>
      </div>
      <div class="layout-footer">
        <div class="layout-footer-body">
            @include('layouts.copyright')</div>
      </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor.min.js')}}"></script>
    <script src="{{ asset('js/elephant.min.js')}}"></script>
    <script src="{{ asset('js/application.min.js')}}"></script>
    <script src="{{ asset('js/demo.min.js')}}"></script>
    {{--    <script src="{{ asset('packages/fontawesome-free/js/all.min.js') }}"></script>--}}

    {{--    <script src="{{ asset('packages/datatables.min.js') }}"></script>--}}
    @yield('additional_scripts')
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
        $("input[required]").parent().addClass("required");
        $(".dataTable").dataTable();
    </script>
  </body>
</html>