<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img class="navbar-brand-logo" src="{{ asset('img/logo.jpeg') }}" alt="Inatrend">
            </a>
        </div>
        <nav id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
{{--                <li><a href="{{route('about')}}">About Us</a></li>--}}

                @foreach(\App\MenuItem::where('menu_id', \App\Menu::MainMenuId())->get() as $menuItem)
                    <li><a href="{{route('load_menu_item', $menuItem)}}" class="text-capitalize">{{ $menuItem->label }}</a></li>
                @endforeach
                <li><a href="{{route('contact')}}">Contact Us</a></li>
{{--                    <li>--}}
{{--                    <div class="navbar-btn-group">--}}
{{--                        <a class="navbar-btn btn btn-primary btn-block" href="signup-1.html">Sign up</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
            </ul>
        </nav>
    </div>
</div>
