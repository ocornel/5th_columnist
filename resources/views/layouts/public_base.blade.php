{{--<!DOCTYPE html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--    <head>--}}
{{--        <meta charset="utf-8">--}}
{{--        <meta name="viewport" content="width=device-width, initial-scale=1">--}}

{{--        <title>Laravel</title>--}}

{{--        <!-- Fonts -->--}}
{{--        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}

{{--        <!-- Styles -->--}}
{{--        <style>--}}
{{--            html, body {--}}
{{--                background-color: #fff;--}}
{{--                color: #636b6f;--}}
{{--                font-family: 'Nunito', sans-serif;--}}
{{--                font-weight: 200;--}}
{{--                height: 100vh;--}}
{{--                margin: 0;--}}
{{--            }--}}

{{--            .full-height {--}}
{{--                height: 100vh;--}}
{{--            }--}}

{{--            .flex-center {--}}
{{--                align-items: center;--}}
{{--                display: flex;--}}
{{--                justify-content: center;--}}
{{--            }--}}

{{--            .position-ref {--}}
{{--                position: relative;--}}
{{--            }--}}

{{--            .top-right {--}}
{{--                position: absolute;--}}
{{--                right: 10px;--}}
{{--                top: 18px;--}}
{{--            }--}}

{{--            .content {--}}
{{--                text-align: center;--}}
{{--            }--}}

{{--            .title {--}}
{{--                font-size: 84px;--}}
{{--            }--}}

{{--            .links > a {--}}
{{--                color: #636b6f;--}}
{{--                padding: 0 25px;--}}
{{--                font-size: 13px;--}}
{{--                font-weight: 600;--}}
{{--                letter-spacing: .1rem;--}}
{{--                text-decoration: none;--}}
{{--                text-transform: uppercase;--}}
{{--            }--}}

{{--            .m-b-md {--}}
{{--                margin-bottom: 30px;--}}
{{--            }--}}
{{--        </style>--}}
{{--    </head>--}}
{{--    <body>--}}
{{--        <div class="flex-center position-ref full-height">--}}
{{--            @if (Route::has('login'))--}}
{{--                <div class="top-right links">--}}
{{--                    @auth--}}
{{--                        <a href="{{ url('/home') }}">Home</a>--}}
{{--                    @else--}}
{{--                        <a href="{{ route('login') }}">Login</a>--}}

{{--                        @if (Route::has('register'))--}}
{{--                            <a href="{{ route('register') }}">Register</a>--}}
{{--                        @endif--}}
{{--                    @endauth--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            <div class="content">--}}
{{--                <div class="title m-b-md">--}}
{{--                    Laravel--}}
{{--                </div>--}}

{{--                <div class="links">--}}
{{--                    <a href="https://laravel.com/docs">Docs</a>--}}
{{--                    <a href="https://laracasts.com">Laracasts</a>--}}
{{--                    <a href="https://laravel-news.com">News</a>--}}
{{--                    <a href="https://blog.laravel.com">Blog</a>--}}
{{--                    <a href="https://nova.laravel.com">Nova</a>--}}
{{--                    <a href="https://forge.laravel.com">Forge</a>--}}
{{--                    <a href="https://github.com/laravel/laravel">GitHub</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </body>--}}
{{--</html>--}}

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
{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700">--}}
    <link rel="stylesheet" href="{{ asset('css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/elephant.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/landing-page.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('packages/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('packages/summernote/summernote.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('packages/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">

    @yield('additional_styles')
    <link href="{{ asset('css/public_styles.css') }}" rel="stylesheet">
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
<script src="{{ asset('packages/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/vendor.min.js')}}"></script>
<script src="{{ asset('js/elephant.min.js')}}"></script>
<script src="{{ asset('packages/summernote/summernote.min.js') }}"></script>
{{--<script src="{{ asset('packages/summernote/summernote.js') }}"></script>--}}

<script src="{{ asset('js/landing-page.min.js')}}"></script>
@yield('additional_scripts')
<script src="{{ asset('js/scripts.js') }}"></script>
<script>
    $("input[required]").parent().addClass("required");
    $(".dataTable").dataTable();
</script>

<script >
    // lazy load images
    const config = {
        rootMargin: '0px 0px 50px 0px',
        threshold: 0
    };

    let observer = new IntersectionObserver(function (entries, self) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                preloadImage(entry.target);
                self.unobserve(entry.target)
            }
        });
    }, config);

    function preloadImage(target) {
        const lazyImage = target;
        lazyImage.src = lazyImage.dataset.src;
    }

    const imgs = document.querySelectorAll('[data-src]');
    imgs.forEach(img => {
        observer.observe(img);
    });

    // Post actions
    function likePost(post_id) {
        console.log('liked post ' + post_id);
    }

    function hatePost(post_id) {
        console.log('hated post ' + post_id);
    }

    // Comment actions
    function likeComment(comment_id) {
        console.log('liked comment ' + comment_id);
    }

    function hateComment(comment_id) {
        console.log('hated comment ' + comment_id);
    }

    function replyComment(comment_id, comment_content) {
        console.log('replying to comment: ' + comment_content);
        document.getElementById('parent_comment_id').value = comment_id;
        document.getElementById('target_comment').innerHTML = "Replying to: "+ comment_content;
    }

    // editor
    $(document).ready(function () {
        $('.public-editor').summernote({
                placeholder: 'Type Content',
                // toolbar: [
                //     ['style', ['bold', 'italic', 'underline', 'clear']],
                //     ['insert', ['hr', 'link', 'table']],
                //     ['font', ['strikethrough', 'superscript', 'subscript']],
                //     ['fontsize', ['fontsize']],
                //     ['color', ['color']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['misc', ['fullscreen', 'undo', 'redo']],
                // ]
            }
        );
    });

</script>
</body>
</html>
