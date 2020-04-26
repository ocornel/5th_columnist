<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h4 class="footer-heading">{{ \App\Option::ValueByKey('Footer Title') }}</h4>
                {!! \App\Option::ValueByKey('Footer Description') !!}
                Backend:
                @guest
                    <a class="nav-link"
                                   href="{{ route('login') }}">{{ __('Login') }}</a> &nbsp;
                    @if (Route::has('register'))
                        <a class="nav-link"
                           href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="{{ route('home') }}">{{ Auth::user()->role_name }}'s Portal</a> &nbsp;
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                        >{{__('Logout')}}</a>
                @endguest
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
            <div class="col-sm-12 col-md-6">
                <div class="row">
                    @foreach(App\Menu::where('name','!=','Main')->get() as $menu)
                        <div class="col-sm-6 col-md-4">
                            <h4 class="footer-heading">{{$menu->name}}</h4>
                            <ul class="footer-links">
                                @foreach($menu->items as $menuItem)
                                    <li>
                                        <a href="{{route('load_menu_item', $menuItem)}}" class="text-capitalize">
                                            <span class="icon icon-angle-right"></span>
                                            {{ $menuItem->label }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
        <p>Copyright &copy; <?php echo date("Y"); ?> <a href="{{ route('landing') }}" target="_blank">Inatrend Kenya</a>
        </p>
    </div>
</div>
