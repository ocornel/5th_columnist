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
{{--    <link rel="manifest" href="{{ asset('docs/manifest.json') }}">--}}
    <link rel="mask-icon" href="{{ asset('img/logo.png') }}" color="#38c8dd">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">
    <link href="{{asset('packages/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('packages/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css')}}">
    <link href="{{asset('packages/summernote/summernote.css')}}" rel="stylesheet" media="all">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.min.css')}}">
{{--    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">--}}

    <link href="{{ asset('css/public_styles.css') }}" rel="stylesheet">
    @yield('additional_styles')
    <style>
        /* Option defined styles*/
        * {
            --default-font-size: {{\App\Option::ValueByKey('Default Font Size','var(--5c-default-font-size)')}};
            --primary-color: {{\App\Option::ValueByKey('Primary Color','var(--5c-blue)')}};
            --primary-text-color: {{\App\Option::ValueByKey('Primary Text Color','var(--5c-dark-grey)')}};
            --secondary-color: {{\App\Option::ValueByKey('Secondary Color','var(--5c-dark-blue')}};
            --secondary-text-color: {{\App\Option::ValueByKey('Secondary Text Color','var(--5c-faint-grey)')}};
            --primary-button-color: {{\App\Option::ValueByKey('Primary Button Color','var(--5c-light-grey)')}};
            --secondary-button-color: {{\App\Option::ValueByKey('Secondary Button Color','var(--5c-dark-grey)')}};
            --danger-button-color: {{\App\Option::ValueByKey('Danger Button Color','var(--5c-danger-red)')}};
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
</head>
<body class="spinner spinner-primary spinner-lg">
@include('layouts.parts.public_topnav')
<div style="min-height: 50px"></div>
{{--    todo messages flash as in rcl flash--}}

@yield('content')
@include('layouts.parts.public_footer')

<script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
{{--<script src="{{ asset('packages/js/dataTables.bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/vendor.min.js')}}"></script>
<script src="{{ asset('packages/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('js/elephant.min.js')}}"></script>
<script src="{{ asset('js/landing-page.min.js')}}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('additional_scripts')
</body>
</html>
